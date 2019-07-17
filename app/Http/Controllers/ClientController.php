<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Title as Title;
use App\Client as Client;

class ClientController extends Controller {
  //
  public function __construct( Title $titles, Client $client ) {
    $this->titles = $titles->all();
    $this->client = $client;
  }

  public function di() {
    dd($this->titles);
  }

  // Client landing page function. Shows all clients.
  public function index() {
    $data = [];
    $data['clients'] = $this->client->all();

    return view('client/index', $data);
  }

  // Provide functionality to download clients
  public function export() {
    $data = [];
    $data['clients'] = $this->client->all();
    // Forces a download
    header('Content-Disposition: attachment; filename=export.xls');

    return view('client/export', $data);
  }

  // New Client function. Executes when the New Client button is clicked. Shows a form for data entry.
  public function newClient(Request $request, Client $client) {
    $data = [];
    $data['title'] = $request->input('title');
    $data['name'] = $request->input('name');
    $data['last_name'] = $request->input('last_name');
    $data['address'] = $request->input('address');
    $data['zip_code'] = $request->input('zip_code');
    $data['city'] = $request->input('city');
    $data['state'] = $request->input('state');
    $data['email'] = $request->input('email');

    if( $request->isMethod('post')){
      //dd($data);
      $this->validate($request, [
        'name' => 'required|min:2',
        'last_name' => 'required',
        'address' => 'required',
        'zip_code' => 'required',
        'city' => 'required',
        'state' => 'required',
        'email' => 'required',
        ]
      );
      // Add the data to the database
      $client->insert($data);

      return redirect('clients');
    }

      $data['titles'] = $this->titles;
      $data['modify'] = 0;

      return view('client/form', $data);
  }

  public function create() {
    return view('client/create');
  }

  // Shows the data of a particular client when the Edit button is pressed
  public function show(Request $request, $client_id) {
    $data = [];
    $data['client_id'] = $client_id;
    $data['titles'] = $this->titles;
    $data['modify'] = 1; // Controls which method to call when the form is saved. See form.blade.php

    // Retrieve data pertaining to a particular client from database and save it in the $data array.
    $client_data = $this->client->find($client_id);
    $data['name'] = $client_data->name;
    $data['last_name'] = $client_data->last_name;
    $data['title'] = $client_data->title;
    $data['address'] = $client_data->address;
    $data['zip_code'] = $client_data->zip_code;
    $data['city'] = $client_data->city;
    $data['state'] = $client_data->state;
    $data['email'] = $client_data->email;

    // Add a key to the session with the first and last name of the client
    $request->session()->put('las_updated', $client_data->name . ' ' . $client_data->last_name);

    // Send the data to the view.
    return view('client/form', $data);
  }

  // Function called when an edit form is saved
  public function modify(Request $request, $client_id, Client $client)
  {
      // Store the input from the user in the $data array
      $data = [];
      $data['title'] = $request->input('title');
      $data['name'] = $request->input('name');
      $data['last_name'] = $request->input('last_name');
      $data['address'] = $request->input('address');
      $data['zip_code'] = $request->input('zip_code');
      $data['city'] = $request->input('city');
      $data['state'] = $request->input('state');
      $data['email'] = $request->input('email');

      // If the form was submitted, validate the fields
      if( $request->isMethod('post')){
          //dd($data);
          $this->validate($request,
              [
                  'name' => 'required|min:2',
                  'last_name' => 'required',
                  'address' => 'required',
                  'zip_code' => 'required',
                  'city' => 'required',
                  'state' => 'required',
                  'email' => 'required',
              ]
          );
          // Find this client from the database
          $client_data = $this->client->find($client_id);

          // Update the existing values
          $client_data->title = $request->input('title');
          $client_data->name = $request->input('name');
          $client_data->last_name = $request->input('last_name');
          $client_data->address = $request->input('address');
          $client_data->zip_code = $request->input('zip_code');
          $client_data->city = $request->input('city');
          $client_data->state = $request->input('state');
          $client_data->email = $request->input('email');

          $client_data->save();

          // Go back to the Clients landing page
          return redirect('clients');
      }

      $data['titles'] = $this->titles;
      $data['modify'] = 0;

      return view('client/form', $data);
  }
}
