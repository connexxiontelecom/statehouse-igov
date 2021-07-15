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
</script>