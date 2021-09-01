<script>
	$(document).ready(() => {
	  $('form#new-vehicle-form').submit(function (e) {
      e.preventDefault()
      let color = $('#fv-color').val()
      let brand = $('#fv-brand').val()
      let maker = $('#fv-maker').val()
      let engineType = $('#fv-engine-type').val()
      let purchasePrice = $('#fv-purchase-price').val()
      let mileage = $('#fv-mileage').val()
      let year = $('#fv-year').val()
      let plateNo = $('#fv-plate-no').val()
      let policyNo = $('#fv-policy-no').val()
      let chassisNo = $('#fv-chassis-no').val()
      let purchaseDate = $('#fv-purchase-date').val()
      let tankCapacity = $('#fv-tank-capacity').val()
      if (!color || !brand || !maker || !engineType || !purchasePrice || !mileage || !year || !plateNo || !policyNo || !chassisNo || !purchaseDate || !tankCapacity) {
        Swal.fire('Invalid Submission!', 'Please fill in all required fields', 'error')
      } else {
        let formData = new FormData(this)
        Swal.fire({
          title: 'Are you sure?',
          text: 'This will register this vehicle in the iGov system',
          type: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Confirm',
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33"
        }).then(confirm => {
          if (confirm.value) {
            $.ajax({
              url: '<?=site_url('new-vehicle')?>',
              type: 'post',
              data: formData,
              success: response => {
                if (response.success) {
                  Swal.fire('Confirmed!', response.message, 'success').then(() => location.href = '<?=site_url('active-vehicles')?>')
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

    $('form#new-driver-form').submit(function(e) {
      e.preventDefault()
      let employee = $('#fd-user-id').val()
      let moi = $('#fd-moi').val()
      let moiExpiry = $('#fd-moi-expiry').val()
      let files = $('#file')[0].files
      if (!employee || !moi || !moiExpiry || !files[0]) {
        Swal.fire('Invalid Submission!', 'Please fill in all required fields', 'error')
      } else {
        let formData = new FormData(this)
        Swal.fire({
          title: 'Are you sure?',
          text: 'This will register this driver in the iGov system',
          type: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Confirm',
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33"
        }).then(confirm => {
          if (confirm.value) {
            $.ajax({
              url: '<?=site_url('new-driver')?>',
              type: 'post',
              data: formData,
              success: response => {
                if (response.success) {
                  Swal.fire('Confirmed!', response.message, 'success').then(() => location.href = '<?=site_url('drivers')?>')
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
	})
</script>