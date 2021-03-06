
<html>

<head>
    <title>UoC Maps</title>
    <link href="<?php echo base_url(); ?>/assets/drawable/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/css/admin_styles.css" >
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/css/fontawesome-all.css" >
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script src="https://apis.google.com/js/platform.js" async defer></script>

    <script>

        function onSignIn(googleUser) {

            const url = "<?php echo site_url("Login/login/") ?>";
            let profile = googleUser.getBasicProfile();
            var id_token = googleUser.getAuthResponse().id_token;


            /*
            console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
            console.log('Name: ' + profile.getName());
            console.log('Image URL: ' + profile.getImageUrl());
            console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
            */

            $.ajax({
                url: url,
                type: 'GET',
                data: { 'email': profile.getEmail(), 'id_token': id_token, 'img': profile.getImageUrl()} ,
                contentType: 'application/json; charset=utf-8',
                success: function (response) {

                    var obj = JSON.parse(response);

                    console.log(obj);

                    if (obj.admin=="true"){
                        console.log(response.admin);
                        window.location.href = "<?php echo site_url('Admin_home'); ?>";
                    }
                    else{
                        console.log(obj.admin);
                    }
                    document.getElementById('signinbutton').style.display = 'none';
                    //link.style.visibility = 'hidden';
                    document.getElementById("gimage").style.display = 'inline';
                    document.getElementById("signoutbutton").style.display = 'inline';
                    //location.reload(false);


                },
                error: function (response) {
                    alert("error");
                    console.log(response);
                }
            });
        }
    </script>

    <script>
        function signOut() {
            var auth2 = gapi.auth2.getAuthInstance();
            auth2.signOut().then(function () {
                //console.log('User signed out.');
                var s = <?php echo json_encode($_SESSION); ?>;
                console.log(s);

                window.location.href="<?php echo base_url('Login/logout'); ?>";

                var s = <?php echo json_encode($_SESSION); ?>;
                console.log(s);

                document.location.href = "https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout?continue=http://localhost/UoCLBSP-WebServer/";

            });

        }

    </script>


<meta name="google-signin-client_id" content="<?php echo $this->config->item('oauth_key');?>">
<!--    <script type = 'text/javascript' src = "--><?php //echo base_url(); ?><!--/assets/js/admin_panel.js"></script>-->
    <?php if($call == True) {
        echo '<script>
                $(function(){
                    $("#cont").load("Admin_home/search");
                });

    </script>';
    }
    ?>
</head>
<body style="color: black;">




<!--<a id="nav-toggle"  class="position"><span></span></a>-->


<header>
           <div class="container">
               <div>
                   <a data-target="Admin_home/search"><img src="<?php echo base_url();?>/assets/drawable/web_icon.png" height="45px"></a>
                   <!--               <input type="text" name="name" id="name" class="form-control" placeholder="Search map.." style="width:300px; margin-left: 10%; margin-top: 0px; margin-bottom: 0px;">-->
                   <div id ="signinbutton" class="g-signin2" data-onsuccess="onSignIn" style="float: right; padding-right: 70px; padding-top: 5px"></div>
                   <!-- <div id ="signoutbutton" style="float: right; padding-right: 70px; padding-top: 5px; display: none"> <button type="button" onclick="signOut()">Sign Out</button>  </div> -->
                   <img id="gimage" src="<?php echo $this->session->userdata('img');?>" height="45px" style="display:none; float: right; padding-right: 35px;">
                   <a id="signoutbutton" href="#" onclick="signOut();" style="display: none; float: right; padding-right: 50px; padding-top: 5px">Sign Out</a>
               </div>

           </div>

</header>




<main>
    <div id="cont">
    </div>
</main>

</body>
</html>