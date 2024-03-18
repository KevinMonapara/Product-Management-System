jQuery("#frm").validate({
  rules: {
    email: {
      required: true,
      email: true,
    },
    pswd: {
      required: true,
    },
  },
  messages: {
    email: {
      required: "Please Enter Email",
      email: "Please Enter Valid Email",
    },
    pswd: {
      required: "Please Enter Password",
    },
  },
});
