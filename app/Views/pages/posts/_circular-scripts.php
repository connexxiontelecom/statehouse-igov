<script>
	$(document).ready(function () {
		$('form#new-internal-memo-form').submit(function (e) {
			e.preventDefault()
			let body = quillEditor.root.innerHTML
			let formData = new FormData(this)
      formData.set('p_body', body)
      Swal.fire({
        title: 'Are you sure?',
        text: 'This will submit your memo to the iGov system',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Confirm',
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33"
      }).then(confirm => {
        if (confirm.value) {
        
          $.ajax({
            url: '<?=site_url('/internal-memo')?>',
            type: 'post',
            data: formData,
            success: response => {
              if (response.success) {
                Swal.fire('Confirmed!', response.message, 'success').then(() => location.href = '<?=site_url('/my-memos')?>')
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

    $('form#edit-memo-form').submit(function (e) {
      e.preventDefault()
      let body = quillEditor.root.innerHTML
      let formData = new FormData(this)
      formData.set('n_body', body)
      Swal.fire({
        title: 'Are you sure?',
        text: 'This will submit new changes to your memo to the iGov system',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Confirm',
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33"
      }).then(confirm => {
        if (confirm.value) {
          $.ajax({
            url: '<?=site_url('/edit-memo')?>',
            type: 'post',
            data: formData,
            success: response => {
              if (response.success) {
                Swal.fire('Confirmed!', response.message, 'success').then(() => location.href = '<?=site_url('/my-memos')?>')
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
