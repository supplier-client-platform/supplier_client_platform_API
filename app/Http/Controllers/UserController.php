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
            User::findOrFail($id)->paginate();
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
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'is_admin' => 0,
                'api_token' => str_random(60),   // TODO: Change this to a unique str_random --CHANGED: NO NEED TO DO THIS.
                'payment_plan' => $data['payment_plan'],
                'personal_contact' => $data['personal_contact'],
                'terms_agreed' => $data['terms_agreed']
            ]);

             Supplier::create([
                'user_id' => $new_user->id,
                'name' => $data['businessName'],
                'email' => $data['businessEmail'],
                'supplier_category_id' => $data['supplierCategory'],
                'contact' => $data['businessContact'],
                'address' => json_encode($data['business_address']),
                'base_city' => $data['baseCity'],
                'image' => $data['imageUrl'],
                'website' => $data['website']
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
                'name' => $data['fullname'],
                'email' => $data['personalEmail'],
                'NIC' => $data['nic'],
                'contact' => $data['personalContact'],
                'image' => $data['image']
            ]);
            return User::findOrFail($id)->paginate();
        } catch (Exception $e) {
            return response(['data' => ['status' => 'fail', 'message' => 'Update failed.']], 400);
        }
    }

    /**
     * Generates a new user api_token; Should be used every two weeks or so.
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function regenerateUserAuth(Request $request, $id) {

        try {
            $user = User::findOrFail($id);

            if (Hash::check($user->password, $request->oldPassword)) {
                $user->password = Hash::make($request->newPassword);
                // No need for unique for api_token.
                // Reason: 64^60 characters are there. Repeat strings will take a long time to occur.
                // i.e. only after 2.3485425827738332e+108 cycles
                $user->api_token = str_random(60);
                $user->save();
                return response(['data' => ['status' => 'success', 'message' => 'Update successful', 'bearer token' => $user->api_token]], 200);
            } else {
                return response(['data' => ['status' => 'fail', 'message' => 'Update failed. Check parameters sent.']], 400);
            }
        } catch (Exception $e) {
            return response(['data' => ['status' => 'fail', 'message' => 'Update failed. Not found.']], 404);
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
