<?php
    if(isset($_POST)){
        switch ($_POST['case']) {
            case '1':
                return register();
                break;
            case '2':
                return otp();
                break;
            case '3':
                return signin();
                break;
            case '4':
                return profile();
                break;
            case '5':
                return logout();
                break;
            default:
                return 0;
                break;
        }
    }else{
        echo 'none';
    }
    function register(){
            
        $url = 'http://pretest-qa.privydev.id/api/v1/register';
        $fields = [
                'phone' => $_POST['phone'],
                'password' => $_POST['password'],
                'country' => $_POST['country'],
                'latlong' => $_POST['latlong'],
                'device_token' =>$_POST['device_token'],
                'device_type' => $_POST['device']
        ];
        //The data you want to send via POST
        // $fields = [
        //     '__VIEWSTATE '      => $state,
        //     '__EVENTVALIDATION' => $valid,
        //     'btnSubmit'         => 'Submit'
        // ];

        //url-ify the data for the POST
        $fields_string = http_build_query($fields);

        //open connection
        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

        //So that curl_exec returns the contents of the cURL; rather than echoing it
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        $result=json_decode(curl_exec($ch),true);
        curl_close($ch);
        session_start();
        $_SESSION['otp']=$result['data']['user'];
        // print_r($_SESSION['otp']);
        header('Location: r_result.php');
    }

    function otp(){
        $url1 = 'http://pretest-qa.privydev.id/api/v1/register/otp/match';
        $url2 = 'http://pretest-qa.privydev.id/api/v1/register/otp/request';
        $fields1 = [
                'user_id' => $_POST['id'],
                'otp_code' => $_POST['sugar_id']
        ];
        $fields2 = [
            'phone' => $_POST['phone']
        ];
        //url-ify the data for the POST
        $fields_string1 = http_build_query($fields1);
        $fields_string2 = http_build_query($fields2);

        //open connection
        $ch1 = curl_init();
        $ch2= curl_init();
        // request
        curl_setopt($ch2,CURLOPT_URL, $url2);
        curl_setopt($ch2,CURLOPT_POST, true);
        curl_setopt($ch2,CURLOPT_POSTFIELDS, $fields_string2);

        //So that curl_exec returns the contents of the cURL; rather than echoing it
        curl_setopt($ch2,CURLOPT_RETURNTRANSFER,1);
        $result2=json_decode(curl_exec($ch2),true);
        curl_close($ch2);

        // match
        //set the url, number of POST vars, POST data
        curl_setopt($ch1,CURLOPT_URL, $url1);
        curl_setopt($ch1,CURLOPT_POST, true);
        curl_setopt($ch1,CURLOPT_POSTFIELDS, $fields_string1);

        //So that curl_exec returns the contents of the cURL; rather than echoing it
        curl_setopt($ch1,CURLOPT_RETURNTRANSFER,1);
        $result1=json_decode(curl_exec($ch1),true);
        curl_close($ch1);
        session_start();
        $_SESSION['otp2']=$result1['data']['user'];
        print_r($_SESSION['otp2']);
        header('Location: signin.php');
    }

    function signin(){
        $url = 'http://pretest-qa.privydev.id/api/v1/oauth/sign_in';
        $fields = [
                'phone' => $_POST['phone'],
                'password' => $_POST['password'],
                'latlong' => $_POST['latlong'],
                'device_token' =>$_POST['device_token'],
                'device_type' => $_POST['device']
        ];

        //url-ify the data for the POST
        $fields_string = http_build_query($fields);

        //open connection
        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

        //So that curl_exec returns the contents of the cURL; rather than echoing it
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        $result=json_decode(curl_exec($ch),true);
        curl_close($ch);
        session_start();
        $_SESSION['access_token']=$result['data']['user']['access_token'];
        // print_r($result);
        header('Location: profile.php');
    }

    function logout(){
        $url = 'http://pretest-qa.privydev.id//api/v1/oauth/revoke';
        session_start();
        $_SESSION['access_token']=$result['data']['user']['access_token'];
        $_SESSION['confirm']=1;
        // print_r($result);
        header('Location: signin.php');
    }

    function profile(){
        session_start();
        $url1="http://pretest-qa.privydev.id/api/v1/profile";
        $url2="http://pretest-qa.privydev.id/api/v1/profile/education";
        $url3="http://pretest-qa.privydev.id/api/v1/profile/career";

        $fields1 = [
            'access_token'=>$_SESSION['access_token'],
            'name' => $_POST['name'],
            'gender' => $_POST['gender'],
            'birthday' => $_POST['birthday'],
            'hometown' => $_POST['hometown'],
            'bio' => $_POST['bio']
        ];

        $fields2 = [
            'access_token'=>$_SESSION['access_token'],
            'school_name' => $_POST['school_name'],
            'graduation_time' => $_POST['grad_time']
        ];

        $fields3 = [
            'access_token'=>$_SESSION['access_token'],
            'position' => $_POST['position'],
            'company_name' => $_POST['company_name'],
            'starting_from' => $_POST['starting_from'],
            'ending_in' => $_POST['ending_in']
        ];
        $fields_string1 = http_build_query($fields1);
        $fields_string2 = http_build_query($fields2);
        $fields_string3 = http_build_query($fields3);

        $ch1 = curl_init();
        $ch2 = curl_init();
        $ch3 = curl_init();
        
        // fields 1
        //set the url, number of POST vars, POST data
        curl_setopt($ch1,CURLOPT_URL, $url1);
        curl_setopt($ch1,CURLOPT_POST, true);
        curl_setopt($ch1,CURLOPT_POSTFIELDS, $fields_string1);

        //So that curl_exec returns the contents of the cURL; rather than echoing it
        curl_setopt($ch1,CURLOPT_RETURNTRANSFER,1);
        $result1=json_decode(curl_exec($ch1),true);
        curl_close($ch1);

        // fields 2
        //set the url, number of POST vars, POST data
        curl_setopt($ch2,CURLOPT_URL, $url2);
        curl_setopt($ch2,CURLOPT_POST, true);
        curl_setopt($ch2,CURLOPT_POSTFIELDS, $fields_string2);

        //So that curl_exec returns the contents of the cURL; rather than echoing it
        curl_setopt($ch2,CURLOPT_RETURNTRANSFER,1);
        $result2=json_decode(curl_exec($ch2),true);
        curl_close($ch2);

        // fields 3
        //set the url, number of POST vars, POST data
        curl_setopt($ch3,CURLOPT_URL, $url3);
        curl_setopt($ch3,CURLOPT_POST, true);
        curl_setopt($ch3,CURLOPT_POSTFIELDS, $fields_string3);

        //So that curl_exec returns the contents of the cURL; rather than echoing it
        curl_setopt($ch3,CURLOPT_RETURNTRANSFER,1);
        $result3=json_decode(curl_exec($ch3),true);
        curl_close($ch3);

        // get data
        $url_get_data = 'http://pretest-qa.privydev.id/api/v1/profile/me/';
        $ch4 = curl_init();
        $get_data=curl_setopt($ch4,CURLOPT_URL, $url_get_data.$_SESSION['access_token']);
        $response = json_decode($get_data, true);
        $_SESSION['profile'] = $response;
        // $errors = $response['response']['errors'];
        // $data = $response['response']['data'][0];
        // session_start();
        // $_SESSION['profile']=$result['data']['user'];
        // $this->getMe();
        header('Location: myProfile.php');
    }

    function getMe(){
        $opts = array(
            'http'=>array(
              'method'=>"GET",
              'header'=>"Authorization: ".$_SESSION['access_token']."\r\n"
            )
          );

        $context = stream_context_create($opts);
        $url = 'http://pretest-qa.privydev.id/api/v1/profile/me';
        // Open the file using the HTTP headers set above
        $file = file_get_contents($url, false, $context);
        echo "tes";
        return $file;
    }

    function testt(){
        echo 'test';
    }
?>
