<div>
    <div class="input-group">
        <input type="text" class="form-control" placeholder="Nhập mã giảm giá" name="voucher" id="voucher" />
        <button class="btn btn-danger" type="button" id="applyVoucher">
            <i class="ti ti-send-2"></i>
        </button>
    </div>
    <input type="hidden" name="discount_amount" value="0">
    <input type="hidden" name="discount_id" value="">
</div>


@push('scripts')
    <script>
        $(document).ready(function() {
            function format_price(price) {
                return new Intl.NumberFormat('vi-VN', {
                    style: 'currency',
                    currency: 'VND',
                    minimumFractionDigits: 0
                }).format(price);
            }

            $('#applyVoucher').on('click', function(e) {

                let voucher = $('#voucher').val();
                let url = '{{ route('discount.apply') }}';
                let data = {
                    _token: '{{ csrf_token() }}',
                    voucher: voucher
                };

                $.ajax({
                    url: url,
                    method: 'POST',
                    data: data,
                    beforeSend: function() {
                        $('#applyVoucher').attr('disabled', true);
                        $('#applyVoucher').html(
                            '<div class="spinner-border spinner-border-sm" role="status"><span class="visually-hidden">Loading...</span></div>'
                        );
                    },
                    success: function(response) {
                        if (response.status === 200) {
                            $('#discount').text('-' + format_price(response.discount));
                            $('input[name="discount_amount"]').val(response.discount);
                            $('input[name="discount_id"]').val(response.discount_id);
                            $('#total').text(format_price(response.total));

                            $('#applyVoucher').replaceWith(
                                '<button class="btn btn-danger" type="button" id="removeVoucher"><i class="ti ti-x"></i></button>'
                            );

                            //disable input
                            $('#voucher').attr('disabled', true);

                            FuiToast.success(response.message);
                        } else {
                            FuiToast.error(response.message);

                            $('#applyVoucher').attr('disabled', false);
                            $('#applyVoucher').html('<i class="ti ti-send-2"></i>');
                        }
                    },
                    error: function(xhr, status, error) {
                        FuiToast.error('Đã có lỗi xảy ra, vui lòng thử lại sau');
                    },
                    complete: function() {
                        $('#applyVoucher').attr('disabled', false);
                    }
                });
            });

            $(document).on('click', '#removeVoucher', function(e) {
                //reset
                $('#discount').text('-0 đ');
                $('input[name="discount_amount"]').val('0');
                $('#total').text(format_price({{ $totalPrice }}));
                $('input[name="voucher"]').val('');
                $('#voucher').attr('disabled', false);

                $('#removeVoucher').replaceWith(
                    '<button class="btn btn-danger" type="button" id="applyVoucher"><i class="ti ti-send-2"></i></button>'
                );
            });
        })
    </script>
@endpush
