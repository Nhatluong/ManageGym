<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveCustomerRequest;
use App\models\Customer;
use App\models\Dtos\CustomerDTO;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    private $customer;
    private $customerDTO;

    public function __construct(Customer $customer, CustomerDTO $customerDTO)
    {
        $this->customer = $customer;
        $this->customerDTO = $customerDTO;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword', null);
        $status = $request->input('status', null);
        $dateLeft = $request->input('date_left', null);

        $customers = $this->customer->getList($keyword, $status, $dateLeft);

        return view('customer.index', compact('customers', 'keyword', 'status', 'dateLeft'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(SaveCustomerRequest $request)
    {
        if($this->customer->saveCustomer($request, $this->customerDTO, $this->customer)) {
            return redirect(route('customers.index'));
        }
        return redirect()->back()
            ->withInput($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
