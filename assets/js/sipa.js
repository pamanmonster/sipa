// Sweet Alert
const flashData = $('.flash-data').data('flashdata'); 
if (flashData) {
    Swal.fire({
        icon: 'success',
        title: 'Sukses',
        text: flashData,
        type: 'success'
    });
}
 