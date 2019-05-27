<?php

add_action( 'rest_api_init', 'wp_webhook_rest_api_route' );

function wp_webhook_rest_api_route() {

    // Registerring a custom REST API Route
    register_rest_route( 
        'webhook/v1', '/endpoint', array(
            'methods'   => 'POST',
            'callback' => 'wp_webhook_rest_api_post_response'
        )
    );

}

// Callback Function For POST REQUEST
function wp_webhook_rest_api_post_response( $request ) {

    $parameters = $request->get_params();
    
    //Give our CSV file a name.
    $csvFileName = 'csvFile.csv';
    
    // Setting Header func for triggering downloading option
    // header( "Content-type: text/csv" );
    // header( "Content-Disposition: attachment; filename:$csvFileName;" );

    $tableHeaders = array( 'Participation ID', 'Participant ID', 'PII Data ID', 'Instant Win Slot ID', 'Pack Code', 'Win ID', 'Email', 'Prize Name', 'Tier', 'Confirmation Link', 'Draw Period', 'Participation Date', 'Is Win Confirmed?', 'Salutation', 'First Name', 'Last Name', 'AddressLine 1', 'AddressLine 2', 'ZipCode', 'Phone Number', 'City', 'Date Of Birth', 'Oreoji Number', 'Gender', 'Size', 'ConfirmationDate' );

    // var_dump(array_keys($parameters));
    

    //Open file pointer.
    // $output = fopen($csvFileName, 'w'); // "w" for overwriting existing content AND "a" for appending new content at the end
    $output = fopen($csvFileName, 'a'); // "w" for overwriting existing content AND "a" for appending new content at the end

    $fp = fputcsv($output, $tableHeaders);
    //Write the row to the CSV file.
    fputcsv($output, $parameters);
    
    //Finally, close the file pointer.
    fclose($output);

}
