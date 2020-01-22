<?php


namespace App\models\Dtos;



use Illuminate\Http\Request;

class CustomerDTO
{
    public function getFormRequest(Request $request)
    {
        return[
            'name' => $request->input('name'),
            'number_phone' => $request->input('number_phone'),
            'package_ticket_id' => $request->input('package_ticket_id'),
            'address' => $request->input('address'),
            'avatar' => $request->file('avatar'),
            'status' => $request->input('status'),
            'date_buy' => $request->input('date_buy'),
            'date_end' => $request->input('date_end'),
            'old_avatar' => $request->input('old_avatar', null)
        ];
    }

}
