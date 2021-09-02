<script>
  $(document).ready(() => {
    $('form#upload-signature-form').submit(e => {
      e.preventDefault()
      let files = $('#file')[0].files
      if (!files[0]) {
        Swal.fire('Invalid Submission!', 'Please upload a scan of your signature.', 'error')
      } else {
        $('#save-btn').attr('hidden', true)
        $('#save-btn-loading').attr('hidden', false)
        let formData = new FormData()
        formData.append('file', files[0])
        $.ajax({
          url: '<?=site_url('/setup-signature')?>',
          type: 'post',
          data: formData,
          success: response => {
            $('#save-btn').attr('hidden', false)
            $('#save-btn-loading').attr('hidden', true)
            if (response.success) {
              Swal.fire('Confirmed!', response.message, 'success').then(() => location.href = '<?=site_url('/my-account')?>')
            } else {
              Swal.fire('Sorry!', response.message, 'error')
            }
          },
          cache: false,
          contentType: false,
          processData: false
        })
      }
    })

    $('form#verify-signature-form').submit(e => {
      e.preventDefault()
      let verCode = $('#ver-code').val()
      let formData = new FormData()
      formData.append('ver_code', verCode)
      $.ajax({
        url: '<?=site_url('/verify-signature')?>',
        type: 'post',
        data: formData,
        success: response => {
          if (response.success) {
            Swal.fire('Confirmed!', response.message, 'success').then(() => location.href = '<?=site_url('/my-account')?>')
          } else {
            Swal.fire('Sorry!', response.message, 'error')
          }
        },
        cache: false,
        contentType: false,
        processData: false
      })
    })
  })

  function submitToken() {
    let token = $('#token-symbol').val()
    if (!token) {
      Swal.fire('Invalid Submission!', 'Please enter the security token', 'error')
    } else {
      let formData = new FormData()
      formData.append('token_symbol', token)
      Swal.fire({
        title: 'Are you sure?',
        text: 'This will create a token in place of your OTP verification code. You must enter your password to continue.',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Confirm',
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33"
      }).then(confirm => {
        if (confirm.value) {
          $.ajax({
            url: '<?=site_url('/submit-token')?>',
            type: 'post',
            data: formData,
            success: response => {
              if (response.success) {
                Swal.fire('Confirmed!', response.message, 'success').then(() => {
                  jQuery.noConflict()
                  $('#standard-modal-3').modal('show');
                })
              } else {
                Swal.fire('Sorry!', response.message, 'error')
              }
            },
            cache: false,
            contentType: false,
            processData: false
          })
        }
      })
    }
  }

  function confirmSecurityToken() {
    let password = $('#password').val()
    if (!password) {
      Swal.fire('Invalid Submission!', 'Please enter your password', 'error')
    } else {
      let formData = new FormData()
      formData.append('password', password)
      Swal.fire({
        title: 'Are you sure?',
        text: 'This will confirm this security token for verifying your actions.',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Confirm',
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33"
      }).then(confirm => {
        if (confirm.value) {
          $.ajax({
            url: '<?=site_url('/confirm-token')?>',
            type: 'post',
            data: formData,
            success: response => {
              if (response.success) {
                Swal.fire('Confirmed!', response.message, 'success').then(() => location.href = '<?=site_url('/my-account')?>')
              } else {
                Swal.fire('Sorry!', response.message, 'error')
              }
            },
            cache: false,
            contentType: false,
            processData: false
          })
        }
      })
    }
  }
</script>