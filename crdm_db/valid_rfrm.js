jQuery("#rfrm").validate({
  rules: {
    username: {
      required: true,
      maxlength: 10,
    },
    email: {
      required: true,
      email: true,
    },
    pswd: {
      required: true,
      maxlength: 10,
    },
  },
  messages: {
    username: {
      required: "Please Enter Username",
      maxlength: "Username must not be more than 10 char",
    },
    email: {
      required: "Please Enter Email",
      email: "Please Enter Valid Email",
    },
    pswd: {
      required: "Please Enter Password",
      maxlength: "Password must not be more than 10 char",
    },
  },
});
