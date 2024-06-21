////F1.  SHOW ONLY CLICKED ITEM for Profile.php page
function showOption(category) {
    // HIDE ALL MENU
    const profileContainer = document.querySelectorAll('.profile-container');
    profileContainer.forEach(container => {
        container.style.display = 'none';
    });
    // SHOW WHEN CLICK ON SPECIFIED ITEM
    const selectedContainer = document.getElementById(`${category}-container`);
    selectedContainer.style.display = 'block';
    // CHANGE APPERANCE WHEN CLICK ON ITEM
    const buttons = document.querySelectorAll('.profile-option-btn li');
    buttons.forEach(li => {
        if (li.getAttribute('data-category') === category) {
            li.classList.add('select-container'); //CSS CLASS
            li.classList.remove('unselect-container');
        } else {
            li.classList.add('unselect-container');
            li.classList.remove('select-container');
        }
    });

}
window.onload = function () {
    showOption('user-details');
};



//F2.  CLICK ON LOGOUT SWAL POPUP FOR CONFIRM LOGOUT
document.querySelector(".logout").addEventListener("click", function () {
    swal.fire({
        // imageUrl:'IMG/logout.png',
        // imageHeight:100,
        title: "Are You Sure",
        text: "You Want To Logout",
        showCancelButton: "Cancel",
        confirmButtonText: "LogOut",
        confirmButtonColor: 'black'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "logout.php";
        } else {

        }
    })
});

//F3. DEACTIVATE OR DELETE ACCOUNT ACTIONN:-
document.querySelector("#deactivate-btn").addEventListener("click", function () {
    swal.fire({
        title: "DELETE ACCOUNT",
        text: "Once Your account is deactivated all your data will be erased and This action can not be reversed",
        // input: 'Password',
        // inputLabel:'rr',
        showCancelButton: "true",
        confirmButtonText: "Delete",
        confirmButtonColor: 'red',
        showLoaderOnConfirm: 'true'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'ajax-manage/deactivate.php',
                type: 'POST',
                success: function (response) {
                    if (response == 0) {
                        swal.fire({
                            title: "Account deactivation Process Failed!",
                            text: "try again later!",
                            icon: "error",
                            confirmButtonColor: 'black'
                        })
                    } else {
                        swal.fire({
                            icon: "success",
                            title: "Account deactivation initiated",
                            confirmButtonColor: 'black'
                        }).then(() => {
                            window.location.href = "logout.php";
                        });
                    }
                },
                error: function () {
                    alert('Error occurred while processing your request.');
                }
            })
        } else {
            alert("result not confirmed");
        }
    });
})

// F4. CHANGE OR UPDATE PASSWORD
document.querySelector("#update-pwd").addEventListener("click", function () {
    var oldPwd = $('#oldPwd').val();
    var newPwd = $('#newPwd_field').val();
    var conPwd = $('#conPwd_field').val();
    if (oldPwd == "" || newPwd == "" || conPwd == "") {
        swal.fire({
            icon: 'warning',
            title: 'Password field must be required',
            confirmButtonColor: 'black'
        });
    } else {
        $.ajax({
            url: 'ajax-manage/update_pwd.php',
            type: 'POST',
            data: {
                oldPwd: oldPwd,
                newPwd: newPwd,
                conPwd: conPwd
            },
            success: function (response) {
                $('#result_response').text(response);
                if (response == 'success') {
                    swal.fire({
                        icon: 'success',
                        title: 'Password Updated Successfully',
                        confirmButtonColor: 'black'
                    });
                }
                else if (response == 'fail' || response == 'new password and confirm password must be same' || response == 'current password mismatch') {
                    $('#result_response').text(response);
                } else{
                    alert('Something Error happened');
                }

            },
            error: function () {
                alert('Error occurred while processing your request.');
            }
        });
    }
});
