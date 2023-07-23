<?php

namespace MHasnainJafri\Cpanel;

use Illuminate\Support\Facades\Config;

class Cpanel
{
    protected $config;
    protected $protocol;
    protected $domain;
    protected $port;
    protected $user;
    protected $token;
    protected $username;

    public function __construct($cpanel_domain = null, $cpanel_api_token = null, $cpanel_username = null, $protocol = 'https', $port = 2083)
    {
        $this->config = Config::get('cpanel');

        // Check if any of the parameters are provided, otherwise use the values from the config array
        $this->protocol = $cpanel_domain ? $protocol : $this->config['protocol'];
        $this->port = $cpanel_domain ? $port : $this->config['port'];
        $this->domain = $cpanel_domain ?? $this->config['domain'];
        $this->username = $cpanel_domain ? $cpanel_username : $this->config['username'];
        $this->token = $cpanel_domain ? $cpanel_api_token : $this->config['api_token'];
    }







/**
 * Get the cPanel disk quota information for the authenticated user.
 *
 * @return array An array with the API response, API URL, status, and error information.
 */
public function getCpanelDiskQuotaInfo()
{
    // Set the cPanel API module and function for getting disk quota info
    $module = "Quota";
    $function = "get_local_quota_info";

    // Call the CpanelApi function to perform the cPanel API request
    return $this->CpanelApi($module, $function);
}

/**
 * Get statistics from the cPanel Stats Bar API endpoint.
 *
 * @param string $display The type of statistics to retrieve, separated by a vertical bar (|).
 * @return array An array with the API response, API URL, status, and error information.
 */
public function getCpanelStatsBarStats($display)
{
    // Set the cPanel API module and function for getting statistics from the StatsBar
    $module = "StatsBar";
    $function = "get_stats";

    // Prepare the parameters for the cPanel API call
    $parameters = array(
        'display' => $display,
    );

    // Call the CpanelApi function to perform the cPanel API request
    return $this->CpanelApi($module, $function, $parameters);
}

/**
 * Create a new POP email account.
 *
 * @param string $username The username for the email account (e.g., 'noreply@xyz.com').
 * @param string $password The password for the email account.
 * @return array An array with the API response, API URL, status, and error information.
 */
public function createPopEmailAccount($username, $password)
{
    // Set the cPanel API module and function for adding POP email account
    $module = "Email";
    $function = "add_pop";

    // Prepare the parameters for the cPanel API call
    $parameters = array(
        'email' => $username, // We use the username as the email prefix
        'password' => $password,
    );

    // Call the CpanelApi function to perform the cPanel API request
    return $this->CpanelApi($module, $function, $parameters);
}


/**
 * Get the count of POP email accounts.
 *
 * @return array An array with the API response, API URL, status, and error information.
 */
public function getPopEmailCount()
{
    // Set the cPanel API module and function for getting POP email account count
    $module = "Email";
    $function = "count_pops";

    // Call the CpanelApi function to perform the cPanel API request
    return $this->CpanelApi($module, $function);
}



/**
 * Delete held email messages for a specific email account.
 *
 * @param string $email The email address for which held messages should be deleted (e.g., 'username@example.com').
 * @return array An array with the API response, API URL, status, and error information.
 */
public function deleteHeldMessages($email)
{
    // Set the cPanel API module and function for deleting held messages
    $module = "Email";
    $function = "delete_held_messages";

    // Prepare the parameters for the cPanel API call
    $parameters = array(
        'email' => $email,
    );

    // Call the CpanelApi function to perform the cPanel API request
    return $this->CpanelApi($module, $function, $parameters);
}

/**
 * Delete a POP email account for the specified email address.
 *
 * @param string $email The email address for which the POP account should be deleted (e.g., 'user@domain.com').
 * @return array An array with the API response, API URL, status, and error information.
 */
public function deletePopEmailAccount($email)
{
    // Set the cPanel API module and function for deleting a POP email account
    $module = "Email";
    $function = "delete_pop";

    // Prepare the parameters for the cPanel API call
    $parameters = array(
        'email' => $email,
    );

    // Call the CpanelApi function to perform the cPanel API request
    return $this->CpanelApi($module, $function, $parameters);
}


/**
 * Send email client configuration settings to a specified email address.
 *
 * @param string $email The email address to which the client settings should be sent (e.g., 'user@example.com').
 * @param string $account The cPanel account username associated with the email address (e.g., 'username').
 * @return array An array with the API response, API URL, status, and error information.
 */
public function dispatchClientSettings($email, $account)
{
    // Set the cPanel API module and function for sending email client settings
    $module = "Email";
    $function = "dispatch_client_settings";

    // Prepare the parameters for the cPanel API call
    $parameters = array(
        'to' => $email,
        'account' => $account,
    );

    // Call the CpanelApi function to perform the cPanel API request
    return $this->CpanelApi($module, $function, $parameters);
}



/**
 * Edit the mailbox quota for a specific email account under a domain.
 *
 * @param string $email The email account (e.g., 'user').
 * @param string $domain The domain associated with the email account (e.g., 'example.com').
 * @param int $quota The new mailbox quota size in megabytes.
 * @return array An array with the API response, API URL, status, and error information.
 */
public function editMailboxQuota($email, $domain, $quota)
{
    // Set the cPanel API module and function for editing the mailbox quota
    $module = "Email";
    $function = "edit_pop_quota";

    // Prepare the parameters for the cPanel API call
    $parameters = array(
        'email' => $email,
        'domain' => $domain,
        'quota' => $quota,
    );

    // Call the CpanelApi function to perform the cPanel API request
    return $this->CpanelApi($module, $function, $parameters);
}


    /**
     * Creates a subdomain on a cPanel hosting account.
     *
     * @param string $subdomain The name of the subdomain to be created.
     * @param string $rootdomain The root domain under which the subdomain will be added.
     * @param string $dir The directory path where the subdomain files will be stored (relative to the root domain).
     * @return array|null The result of the cPanel API call or null if an error occurs.
     */
    public function createSubDomain($subdomain, $rootdomain, $dir)
    {
        // Set the cPanel API module and function for adding a subdomain
        $module = "SubDomain";
        $function = "addsubdomain";

        // Prepare the parameters for the cPanel API call
        $parameters = array(
            'domain'        => $subdomain,     // The name of the subdomain to be created
            'rootdomain'    => $rootdomain,    // The root domain under which the subdomain will be added
            'canoff'        => 0,              // Can park or addon domain flag (0: disable, 1: enable)
            'dir'           => $dir,           // The directory path where the subdomain files will be stored
            'disallowdot'   => 0               // Disallow period (dot) in subdomain name flag (0: allow, 1: disallow)
        );

        // Make the cPanel API call and return the result
        return $this->CpanelApi($module, $function, $parameters);
    }


    /**
     * Creates a new database in cPanel.
     *
     * @param string $database_name The name of the database with the prefix of domain to be created.
     * @return array An array with the API response or error information.
     */
    public function createDatabase($database_name)
    {
        // Set the cPanel API module and function for creating a database
        $module = "Mysql";
        $function = "create_database";

        // Prepare the parameters for the cPanel API call
        $parameters = array(
            'name' => $database_name    // The name of the database to be created
        );

        // Make the cPanel API call and return the result
        return $this->CpanelApi($module, $function, $parameters);
    }


    /**
     * Deletes an existing database in cPanel.
     *
     * @param string $database_name The name of the database to be deleted.
     * @return array An array with the API response or error information.
     */
    public function deleteDatabase($database_name)
    {
        // Set the cPanel API module and function for deleting a database
        $module = "Mysql";
        $function = "delete_database";

        // Prepare the parameters for the cPanel API call
        $parameters = array(
            'name' => $database_name    // The name of the database to be deleted
        );

        // Make the cPanel API call and return the result
        return $this->CpanelApi($module, $function, $parameters);
    }

    /**
     * Retrieves a list of databases available in cPanel.
     *
     * @return array An array with the API response containing the list of databases or error information.
     */
    public function listDatabases()
    {
        // Set the cPanel API module and function for listing databases
        $module = "Mysql";
        $function = "list_databases";

        // No specific parameters needed for listing databases, so an empty array is used
        $parameters = array();

        // Make the cPanel API call and return the result
        return $this->CpanelApi($module, $function, $parameters);
    }


    /**
     * Creates a new database user in cPanel.
     *
     * @param string $username The username of the database user to be created.
     * @param string $password The password for the new database user.
     * @return array An array with the API response or error information.
     */
    public function createDatabaseUser($username, $password)
    {
        // Set the cPanel API module and function for creating a database user
        $module = "Mysql";
        $function = "create_user";

        // Prepare the parameters for the cPanel API call
        $parameters = array(
            'name' => $username,    // The username of the database user to be created
            'password' => $password // The password for the new database user
        );

        // Make the cPanel API call and return the result
        return $this->CpanelApi($module, $function, $parameters);
    }

    /**
     * Deletes an existing database user in cPanel.
     *
     * @param string $username The username of the database user to be deleted.
     * @return array An array with the API response or error information.
     */
    public function deleteDatabaseUser($username)
    {
        // Set the cPanel API module and function for deleting a database user
        $module = "Mysql";
        $function = "delete_user";

        // Prepare the parameters for the cPanel API call
        $parameters = array(
            'name' => $username    // The username of the database user to be deleted
        );

        // Make the cPanel API call and return the result
        return $this->CpanelApi($module, $function, $parameters);
    }


    /**
     * Sets all privileges for a database user on a specific database in cPanel.
     *
     * @param string $database_user The username of the database user.
     * @param string $database_name The name of the database.
     * @return array An array with the API response or error information.
     */
    public function setAllPrivilegesOnDatabase($database_user, $database_name)
    {
        // Set the cPanel API module and function for setting privileges on a database
        $module = "Mysql";
        $function = "set_privileges_on_database";

        // Prepare the parameters for the cPanel API call
        $parameters = array(
            'user' => $database_user,    // The username of the database user
            'database' => $database_name, // The name of the database
            'privileges' => 'ALL PRIVILEGES', // Set all privileges for the user on the database
        );

        // Make the cPanel API call and return the result
        return $this->CpanelApi($module, $function, $parameters);
    }

    /**
     * Generic function to call a cPanel UAPI (User-API) method.
     * This function acts as a wrapper for the 'call' method.
     *
     * @param string $Module The cPanel UAPI module name.
     * @param string $function The cPanel UAPI function name.
     * @param array $parameters_array The array of parameters to pass to the cPanel UAPI call.
     * @return array An array with the API response or error information.
     */
    public function callUAPI($Module, $function, $parameters_array = array())
    {
        return $this->CpanelApi($Module, $function, $parameters_array);
    }


    /**
     * Performs a cURL request to the cPanel API.
     *
     * @param string $module The cPanel API module to be called.
     * @param string $function The function within the cPanel API module to be executed.
     * @param array $args The parameters to be passed to the cPanel API call.
     * @return array An array with the API response, status, and error information.
     */
    public function CpanelApi($module, $function, $args = array())
    {
        // Prepare the parameters for the cPanel API call
        $parameters = '';
        if (count($args) > 0) {
            foreach ($args as $key => $value) {
                $parameters .= '&' . $key . '=' . urlencode($value);
            }
        }

        // Construct the API call URL
        $url = $this->protocol . '://' . $this->domain . ':' . $this->port . '/execute/' . $module;
        $url .= "/" . $function;
        if (count($args) > 0) {
            $url .= '?' . $parameters;
        }

        // Set headers for the cURL request
        $headers = array(
            "Authorization: cpanel " . $this->username . ':' . $this->token,
            "cache-control: no-cache"
        );

        // Initialize cURL
        $curl = curl_init();

        // Configure cURL options
        curl_setopt_array($curl, array(
            CURLOPT_PORT => $this->port,
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => $headers,
        ));

        // Disable SSL verification (for localhost or self-signed certificates)
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

        // Execute the cURL request and capture the response
        $curl_res = curl_exec($curl);
        $err = curl_error($curl);
        $err_no = curl_errno($curl);
        $header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
        $header = substr($curl_res, 0, $header_size);
        $body = substr($curl_res, $header_size);

        // Close the cURL session
        curl_close($curl);

        // Decode the cURL response
        $curl_response_decoded = json_decode($curl_res);

        // Prepare the response array
        $response = array();

        // Store API call details and response data in the response array
        $response['inputs']['url'] = $url;
        $response['curl_response'] = array(
            'curl_response' => $curl_res,
            'curl_response_decoded' => $curl_response_decoded,
            'header_size' => $header_size,
            'headers' => $headers,
            'header' => $header,
            'body' => $body,
            'error' => $err,
            'err_no' => $err_no,
        );

        // Check for cURL errors and handle them
        if (!empty($err_no)) {
            $response['status'] = 'failed';
            $response['errors'] = [$err];
            return $response;
        }

        // Check for API errors and handle them
        if (isset($curl_response_decoded->errors) && count($curl_response_decoded->errors) > 0) {
            $response['status'] = 'failed';
            if (is_object($curl_response_decoded->errors)) {
                $curl_response_decoded->errors = (array) $curl_response_decoded->errors;
            }
            if (is_array($curl_response_decoded->errors)) {
                $response['errors'] = $curl_response_decoded->errors;
            } else {
                $response['errors'] = [$curl_response_decoded->errors];
            }
            return $response;
        } else {
            // If no errors found, check for response status
            if (isset($curl_response_decoded->status) && $curl_response_decoded->status == 0) {
                $response['status'] = 'failed';
                $response['errors'] = [$curl_response_decoded->errors];
                return $response;
            } else {
                $response['data'] = json_decode($curl_res);
                $response['status'] = 'success';
                return $response;
            }
        }
    }
}
