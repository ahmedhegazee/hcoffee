<script>
    function deleteRecord(itemID){
            Swal.fire({
            title: 'هل انت متاكد؟',
            text: "سيتم تغيير حالة الحجز",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'موافق',
            CancelButtonText: 'الالغاء',
            }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire(
                            'تم بنجاح',
                            'تم تغيير حالة الحجز بنجاح',
                            'success'
                                );
                                setTimeout(()=>{
                                    document.getElementById(`update-form-${itemID}`).submit();
                                },2000);

                            }
            })
        }
        function changeReservationStatus(recordID){
            let value = document.getElementById(`reservation-status-${recordID}`).value;
            document.getElementById(`update-${recordID}`).value=value;
        }
</script>
