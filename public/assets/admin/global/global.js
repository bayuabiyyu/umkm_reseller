// Ajax CSRF
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// Init toast
toastr.options = {
  "closeButton": true,
  "escapeHtml": false,
  "progressBar": true,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "2000", // Timeout hide
};

let toastrSuccess = (text) => {
  toastr.success(text);
};

let toastrError = (text) => {
  toastr.error(text);
};
