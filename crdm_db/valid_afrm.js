jQuery("#afrm").validate({
  rules: {
    product_name: {
      required: true,
    },
    product_details: {
      required: true,
    },
    product_count: {
      required: true,
      maxlength: 3,
    },
    image: {
      required: true,
    },
  },
  messages: {
    product_name: {
      required: "Please Enter Name",
    },
    product_details: {
      required: "Please Enter Category",
    },
    product_count: {
      required: "Please Enter Stock",
      maxlength: "Stock must not be more than 3 char",
    },
    image: {
      required: "Please Select Image",
    },
  },
});
