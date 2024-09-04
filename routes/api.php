<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('refresh', function () {
    $userRequiredFields = ['id', 'first_name', 'last_name']; // excluding email, password, address, email_verified_at, remember_token
    $orderFields = ['id', 'user_id', 'status']; // ignoring total, payment_type,
    $productFields = ['id', 'name',]; // ignoring description, price, stock,

    // Fetch the first user, with orders and products using the required fields
    $relatedQuery = [
        'orders' => function ($query) use ($orderFields) {
            $query->select($orderFields);
        },
        'orders.products' => function ($query) use ($productFields) {
            $query->select($productFields);
        },
    ];

    $user = App\Models\User::with($relatedQuery)->first($userRequiredFields);

    // dd(json_encode([
    //     'efficient_query' => $user->toArray(), // comment this out if you want to see the difference
    // ]));

    // Sample Response from the above
    /**
     * {"efficient_query":{"id":1,"first_name":"Test","last_name":"User","orders":[{"id":1,"user_id":1,"status":"cancelled","products":[{"id":3,"name":"qui","pivot":{"order_id":1,"product_id":3,"quantity":1,"price":56,"created_at":"2024-09-04T16:11:37.000000Z","updated_at":"2024-09-04T16:11:37.000000Z"}}]},{"id":2,"user_id":1,"status":"cancelled","products":[{"id":4,"name":"laboriosam","pivot":{"order_id":2,"product_id":4,"quantity":2,"price":20,"created_at":"2024-09-04T16:11:37.000000Z","updated_at":"2024-09-04T16:11:37.000000Z"}},{"id":5,"name":"aspernatur","pivot":{"order_id":2,"product_id":5,"quantity":2,"price":20,"created_at":"2024-09-04T16:11:37.000000Z","updated_at":"2024-09-04T16:11:37.000000Z"}}]},{"id":3,"user_id":1,"status":"completed","products":[{"id":1,"name":"similique","pivot":{"order_id":3,"product_id":1,"quantity":5,"price":23,"created_at":"2024-09-04T16:11:37.000000Z","updated_at":"2024-09-04T16:11:37.000000Z"}},{"id":2,"name":"consectetur","pivot":{"order_id":3,"product_id":2,"quantity":5,"price":23,"created_at":"2024-09-04T16:11:37.000000Z","updated_at":"2024-09-04T16:11:37.000000Z"}}]}]}}
     */

     // Please Ignore Trying to Use fresh()->load(), it is not the same as with()
     //Now call refresh on this and observe a difference
     dd([
        json_encode(['refreshed_query' => $user->refresh()->toArray()]),
     ]);

     // Sample Response from the above
     /**
      * {"refreshed_query":{"id":1,"first_name":"Test","last_name":"User","email":"test@example.com","email_verified_at":"2024-09-04T16:11:37.000000Z","address":"82450 Alejandrin Shoals\nHoppeburgh, OH 72654","created_at":"2024-09-04T16:11:37.000000Z","updated_at":"2024-09-04T16:11:37.000000Z","orders":[{"id":1,"user_id":1,"status":"cancelled","total":1267.38,"payment_type":"bank_transfer","created_at":"2024-09-04T16:11:37.000000Z","updated_at":"2024-09-04T16:11:37.000000Z"},{"id":2,"user_id":1,"status":"cancelled","total":916.14,"payment_type":"paypal","created_at":"2024-09-04T16:11:37.000000Z","updated_at":"2024-09-04T16:11:37.000000Z"},{"id":3,"user_id":1,"status":"completed","total":1255.9,"payment_type":"bank_transfer","created_at":"2024-09-04T16:11:37.000000Z","updated_at":"2024-09-04T16:11:37.000000Z"}]}}
      */

      // The refreshed_query has all the fields in the user model, and the orders have all the fields in the order model, but the products are missing the fields in the product model
    return response()->json(['message' => 'Refreshed']);
});
