<?php



class GoogleOAuthHandler
{
    // Google API Client instance
    private $client;

    public function __construct($client)
    {
        $this->client = $client;
    }

    // Get the login URL for Google OAuth
    public function getLoginUrl()
    {
        return $this->client->createAuthUrl();
    }

    // Handle the OAuth callback
    public function handleCallback($connetion)
    {
        if (isset($_GET['code'])) {
            $token = $this->client->fetchAccessTokenWithAuthCode($_GET['code']);
            if (isset($token['error'])) {
                header('Location: oauth-google.php');
                exit;
            }
            require_once(__DIR__ . "/../src/home/sign-in/log-in/init-session.php");
            $_SESSION['token'] = $token;

            // Set Access để access to Google Service get Data User
            $this->client->setAccessToken($token);
            $google_oauth = new Google\Service\Oauth2($this->client);
            
            // Fetch user data from the Google account
            $user_info = $google_oauth->userinfo->get();

            $google_id = isset($user_info['id']) ? trim($user_info['id']) : '';
            $f_name = isset($user_info['given_name']) ? trim($user_info['given_name']) : '';
            $l_name = isset($user_info['family_name']) ? trim($user_info['family_name']) : '';
            $email = isset($user_info['email']) ? trim($user_info['email']) : '';
            $gender = isset($user_info['gender']) ? trim($user_info['gender']) : '';
            $local = isset($user_info['local']) ? trim($user_info['local']) : '';
            $picture = isset($user_info['picture']) ? trim($user_info['picture']) : '';

            
            // Checking whether the email already exists in the database.
            $check_email = $connetion->prepare("SELECT `email` FROM `usersOauth` WHERE `email`=:email");
            $check_email->bindParam(":email", $email, PDO::PARAM_STR);
            $check_email->execute();
            $check_email_result = $check_email->fetch(PDO::FETCH_ASSOC);

            if ($check_email->rowCount() === 0) {
                // Insert the new user into the database
                $query_template = "INSERT INTO `usersOauth` (`oauth_uid`, `first_name`, `last_name`,`email`,`profile_pic`,`gender`,`local`) VALUES (?,?,?,?,?,?,?)";
                $insert_stmt = $connetion->prepare($query_template);
                $insert_stmt->bindParam(1, $google_id);
                $insert_stmt->bindParam(2, $f_name);
                $insert_stmt->bindParam(3, $l_name);
                $insert_stmt->bindParam(4, $email);
                $insert_stmt->bindParam(5, $picture);
                $insert_stmt->bindParam(6, $gender);
                $insert_stmt->bindParam(7, $local);
                if (!$insert_stmt->execute()) {
                    echo "Failed to insert user. Error: " . $insert_stmt->errorInfo()[2];
                    exit;
                }
            }
            header('Location: ../../homepage/homepage.php');
            exit;
            
        }
    }
}


?>
