// $(document).ready(function() {
//     $('#newPwd_field').on('focus', function() {
//         $('.pwd_validation').slideDown();
//     });
//     $('#newPwd_field').on('blur', function() {
//         $('.pwd_validation').slideUp();
//     });
//     $('#passwordForm').on('submit', function(e) {
//         e.preventDefault();
//     })
//     $('#newPwd_field').on('keyup', function() {
//         passValue = $(this).val();

//         if (passValue.match(/[A-Z]/g)) {
//             $('.upperCase').addClass('active');
//         } else {
//             $('.upperCase').removeClass('active');
//         }
//         if (passValue.match(/[a-z]/g)) {
//             $('.lowerCase').addClass('active');
//         } else {
//             $('.lowerCase').removeClass('active');
//         }
//         if (passValue.match(/[0-9]/g)) {
//             $('.digit').addClass('active');
//         } else {
//             $('.digit').removeClass('active');
//         }
//         if (passValue.match(/[!@#$%^&*]/g)) {
//             $('.symbol').addClass('active');
//         } else {
//             $('.symbol').removeClass('active');
//         }
//         if (passValue.length == 8 || passValue.length > 8) {
//             $('.length').addClass('active');
//         } else {
//             $('.length').removeClass('active');
//         }
//     });
//     $('#conPwd_field').on('keyup', function(){
//         var pwd = $('#newPwd_field').val();
//         var cpwd = $('#conPwd_field').val();
//         if(cpwd.length >= 8 && pwd != cpwd){
//             $('#matchError').html('**Password doesn\'t match');
//             $('#matchError').css('color','red');
//             return false;
//         } else {
//             $('#matchError').html('');
//             return true;
//         }
//     })
// });