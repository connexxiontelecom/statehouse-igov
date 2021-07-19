<script>
	$(document).ready(function () {
		$('form#new-notice-form').submit(function (e) {
			e.preventDefault()
      let subject = $('#subject').val()
      let signedBy = $('#signed-by').val()
      if (!subject || !signedBy || quillEditor.root.innerText.length < 2) {
        Swal.fire('Invalid Submission!', 'Please fill in all required fields', 'error')
      } else {
        let body = quillEditor.root.innerHTML
        let formData = new FormData(this)
        formData.set('body', body)
        Swal.fire({
          title: 'Are you sure?',
          text: 'This will submit your notice to the iGov system',
          type: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Confirm',
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33"
        }).then(confirm => {
          if (confirm.value) {
            $.ajax({
              url: '<?=site_url('/new-notice')?>',
              type: 'post',
              data: formData,
              success: response => {
                if (response.success) {
                  Swal.fire('Confirmed!', response.message, 'success').then(() => location.href = '<?=site_url('/my-notices')?>')
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
    })

    $('form#edit-notice-form').submit(function (e) {
      e.preventDefault()
      let body = quillEditor.root.innerHTML
      let formData = new FormData(this)
      formData.set('body', body)
      Swal.fire({
        title: 'Are you sure?',
        text: 'This will submit new changes to your Notice to the iGov system',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Confirm',
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33"
      }).then(confirm => {
        if (confirm.value) {
          $.ajax({
            url: '<?=site_url('/edit-notice')?>',
            type: 'post',
            data: formData,
            success: response => {
              if (response.success) {
                Swal.fire('Confirmed!', response.message, 'success').then(() => location.href = '<?=site_url('/my-notices')?>')
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
    })
  })
</script>