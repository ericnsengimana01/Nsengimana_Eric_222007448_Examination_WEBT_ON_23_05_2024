<script type="text/javascript">
        //declare Variables to be used
        var divs = ["errorFirst", "errorLast","errorusername", "errorgender", "erroremail", "errortelephone","errorpassword" ];

        //Validation function
        function validate() {
            //just for input element
            var inputs = [
                document.getElementById('firstname').value,
                document.getElementById('lastname').value,
                document.getElementById('username').value,
                document.getElementById('gender').value
                document.getElementById('email').value,
                document.getElementById('telephone').value,
                document.getElementById('password').value
                
                
            ];

            //just for errors
            var errors = [
                "Please enter your Firstname!",
                "Please enter your Lastname!",
                "Please enter your username",
                "Please enter your gender!"
                "Please enter your email",
                "Please enter your telephone",
                "Please enter your password!",
                
            ];

            //we need to iterate through inputs
            for (var i = 0; i < inputs.length; i++) {
                var errorMessage = errors[i];
                var div = divs[i];
                if (inputs[i] == "") {
                    document.getElementById(div).innerHTML = errorMessage;
                } else {
                    document.getElementById(div).innerHTML = "OK!";
                }
            }
        }

        function finalValidate() {
            var count = 1;
            for (var i = 1; i < 7; i++) {
                var div = divs[i];
                if (document.getElementById(div).innerHTML == "OK!") {
                    count++;
                }
            }
            if (count == 7) {
                document.getElementById("errorfinal").innerHTML = "All the data you entered are correct!";
            }
        }
    </script>
