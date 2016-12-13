<?php

namespace App\Http\Controllers;

use App\Supplier;
use App\User;
use App\Brand;
use Illuminate\Http\Request;
use Exception;
use App\Http\Requests;
use App\Branch;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /*
   |--------------------------------------------------------------------------
   | User Controller
   |--------------------------------------------------------------------------
   | Since this application is a REST API, authentication is stateless.
   | Hence we implement our own User Controller instead of using
   | standard Auth Controller.
   */

    /**
     * Returns all the users
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function getAllUsers() {
        try {
            return User::paginate(15);
        } catch (Exception $e) {
            return response('Retireval failed.', 500);
        }
    }

    /**
     * Selcts a user by user id and returns
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function getUserByID($id) {

        try{
            $user = User::findOrFail($id);

            return response(['data' => $user], 200);

        }catch (Exception $e) {
            return response(['data' => ['status' => 'fail', 'message' => 'User Not found.']], 404);
        }
    }

    /**
     * Create and save a new user instance
     * @param Request $request
     * @return mixed
     */
    public function createNewUser(Request $request) {
        $data = $request->all();

        try {
            $new_user = User::create([
                'name' => $data['fullname'],
                'email' => $data['personal_email'],
                'password' => bcrypt($data['password']),
                'is_admin' => 0,
                'api_token' => str_random(60),
                'payment_plan' => $data['payment_plan'],
                'personal_contact' => $data['personal_contact'],
                'terms_agreed' => $data['terms_agree']
            ]);

            $supplier = Supplier::create([
                'user_id' => $new_user->id,
                'name' => $data['company_name'],
                'email' => $data['company_email'],
                'supplier_category_id' => $data['supplier_category'],
                'contact' => $data['company_contact'],
                'address' => json_encode($data['business_address']),
                'base_city' => $data['base_city'],
                //'image' => $data['imageUrl'], Image url is updated after account creation.
                'website' => $data['company_website']
            ]);

            Brand::create([
                'brandname' => 'N/A',
                'supplier_id' => $supplier->id,
            ]);

            Mail::queue('emails.welcome', ['data' => $new_user], function ($m) use ($new_user) {
                $m->from(env('MAIL_FROM'), env('MAIL_NAME'));

                $m->to($new_user->email, $new_user->name)->subject('Welcome to Supplier Client Platform!');
            });

            Mail::queue('emails.business_reg', ['data' => $supplier], function ($m) use ($supplier) {
                $m->from(env('MAIL_FROM'), env('MAIL_NAME'));

                $m->to($supplier->email, $supplier->name)->subject('Supplier Client Platform Business registration');
            });

            return response(['data' => ['status' => 'success', 'message' => 'Creation successful']], 200);
        } catch (Exception $e) {
            return response(['data' => ['status' => 'fail', 'message' => 'Creation failed.']], 500);
        }
    }

    /**
     * Update user information
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function updateUser(Request $request, $id) {
        $data = $request->all();

        try {
            User::where('id', $id)->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'NIC' => $data['NIC'],
                'contact' => $data['contact'],
                'image' => $data['image']
            ]);
            return response(['data' => ['status' => 'success', 'message' => 'Update successful']], 200);
        } catch (Exception $e) {
            return response(['data' => ['status' => 'fail', 'message' => 'Update failed.']], 400);
        }
    }

    /**
     * Generates a new user api_token; Should be used every two weeks or so.
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function regenerateUserAuth(Request $request) {

        try {
            $user = User::where('email', $request->email)->firstOrFail();
           
            if (Hash::check($request->password, $user->password)) {
                // $user->password = Hash::make($request->newPassword);
                // No need for unique for api_token.
                // Reason: 64^60 characters are there. Repeat strings will take a long time to occur.
                // i.e. only after 2.3485425827738332e+108 cycles
                $user->api_token = str_random(60);
                $user->save();
                return response(['data' => ['status' => 'success', 'message' => 'Auth successful', 'token' => $user->api_token, 'id'=> $user->id]], 200);
            } else {
                return response(['data' => ['status' => 'fail', 'message' => 'Auth failed. Check parameters sent.']], 400);
            }
        } catch (Exception $e) {
            return response(['data' => ['status' => 'fail', 'message' => 'Auth failed. Not found.']], 404);
        }
    }

    /**
     * Changes the password.
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function changePassword(Request $request) {

        try {
            $user = User::findOrFail($request->id);

            if (Hash::check($request->password, $user->password)) {
                 $user->password = Hash::make($request->newPassword);
                $user->save();

                Mail::queue('emails.pass_change', ['data' => $user], function ($m) use ($user) {
                    $m->from(env('MAIL_FROM'), env('MAIL_NAME'));

                    $m->to($user->email, $user->name)->subject('Password change');
                });

                return response(['data' => ['status' => 'success', 'message' => 'Password reset successful']], 200);
            } else {
                return response(['data' => ['status' => 'fail', 'message' => 'Password reset failed. Wrong existing Password.']], 400);
            }
        } catch (Exception $e) {
            return response(['data' => ['status' => 'fail', 'message' => 'Password reset failed. Not found.']], 404);
        }
    }

    public function resetPassword(Request $request) {

        try {
            $user = User::where('email', $request->email)->firstOrFail();
            $newPassword =  str_random(8);
            $user->password = Hash::make($newPassword);
            $user->save();
            $data2 = [
                'newPassword' => $newPassword
            ];

            Mail::queue('emails.pass_reset', ['data' => $user, 'data2' => $data2], function ($m) use ($user) {
                $m->from(env('MAIL_FROM'), env('MAIL_NAME'));

                $m->to($user->email, $user->name)->subject('Password reset');
            });
            return response(['data' => ['status' => 'success', 'message' => 'Password reset successful']], 200);
        } catch (Exception $e) {
            return response(['data' => ['status' => 'fail', 'message' => 'Password reset failed. Not found.']], 404);
        }
    }

    /**
     * Deletes a user by given id
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function deleteUser($id) {

        try {
            $user = User::findOrFail($id);
            $user->delete();
            return [
                'data' => $user
            ];
        } catch (Exception $e) {
            return response('Not found', 404);
        }
    }
}
