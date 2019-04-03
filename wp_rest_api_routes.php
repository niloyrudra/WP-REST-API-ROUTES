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
    
    //Open file pointer.
    // $fp = fopen($csvFileName, 'w'); // "w" for overwriting existing content
    $fp = fopen($csvFileName, 'a'); // "a" for appending new content at the end
    
    //Write the row to the CSV file.
    fputcsv($fp, $parameters);
    
    //Finally, close the file pointer.
    fclose($fp);

}
