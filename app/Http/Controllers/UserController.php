<?php

namespace App\Http\Controllers;

use App\Supplier;
use App\User;
use Illuminate\Http\Request;
use Exception;
use App\Http\Requests;
use Illuminate\Support\Facades\Hash;

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

    // TODO: Create a separate method to add new admins, if it is needed.
    // TODO: Add a validator method to validate password length, name(required) and email(required)
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
                'api_token' => str_random(60),   // TODO: Change this to a unique str_random --CHANGED: NO NEED TO DO THIS.
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
            $user = User::where('email', $request->email)->firstOrFail();

            if (Hash::check($request->password, $user->password)) {
                 $user->password = Hash::make($request->newPassword);
                $user->save();
                return response(['data' => ['status' => 'success', 'message' => 'Password reset successful']], 200);
            } else {
                return response(['data' => ['status' => 'fail', 'message' => 'Password reset failed. Check parameters sent.']], 400);
            }
        } catch (Exception $e) {
            return response(['data' => ['status' => 'fail', 'message' => 'Password reset failed. Not found.']], 404);
        }
    }

    public function resetPassword(Request $request) {

        try {
            $user = User::where('email', $request->email)->firstOrFail();
            // TODO : Send a mail to this email with a randomly generated password
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
