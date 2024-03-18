jQuery("#ifrm").validate({
  rules: {
    record_ids: {
      required: true,
    },
    images: {
      required: true,
    },
  },
  messages: {
    record_ids: {
      required: "Please Enter Id",
    },
    images: {
      required: "Please Select Image",
    },
  },
});
