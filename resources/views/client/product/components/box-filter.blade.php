@push('styles')
    <style>
        .hidden-checkbox {
            display: none;
        }

        .custom-label {
            display: inline-block;
            cursor: pointer;
            padding: 6px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #f9f9f9;
            transition: all 0.3s ease;
            user-select: none;
        }

        .custom-label:hover {
            background-color: #f0f0f0;
        }

        .hidden-checkbox:checked+.custom-label {
            background-color: rgb(255, 58, 58);
            color: white;
            border-color: red;
        }
    </style>
@endpush

<div class="bg-white">
    <div class="accordion" id="accordion">

        @foreach ($attributes as $attribute)
            <div class="accordion-item border-0">
                <h2 class="accordion-header" id="heading-{{ $attribute->id }}">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse-{{ $attribute->id }}" aria-expanded="false">
                        {{ $attribute->name }}
                    </button>
                </h2>
                <div id="collapse-{{ $attribute->id }}"
                    class="accordion-collapse collapse {{ request()->has($attribute->slug) ? 'show' : '' }}"
                    data-bs-parent="#accordion-{{ $attribute->id }}">
                    <div class="accordion-body pt-0">
                        <ul class="list-unstyled d-flex align-items-start flex-wrap gap-2">
                            @php
                                $attributeValues = $attribute->values;
                                $attributeValues = $attributeValues->unique('value');
                            @endphp
                            @foreach ($attributeValues as $attributeValue)
                                <li>
                                    <input type="checkbox" class="hidden-checkbox" name="{{ $attribute->slug }}"
                                        id="{{ $attribute->id }}-{{ $attributeValue->id }}"
                                        value="{{ $attributeValue->value }}"
                                        {{ request($attribute->slug) == $attributeValue->value ? 'checked' : '' }}>
                                    <label class="custom-label" for="{{ $attribute->id }}-{{ $attributeValue->id }}">
                                        {{ $attributeValue->value }}
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="accordion-item border-0">
            <h2 class="accordion-header" id="heading-price">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapse-price" aria-expanded="false">
                    Khoảng giá
                </button>
            </h2>
            <div id="collapse-price" class="accordion-collapse collapse {{ request()->has('price') ? 'show' : '' }} "
                data-bs-parent="#accordion-price">
                <div class="accordion-body pt-0">
                    <ul class="list-unstyled d-flex align-items-start flex-wrap gap-2">
                        @php
                            $labels = [
                                'Dưới 1 triệu',
                                '1 - 2 triệu',
                                '2 - 3 triệu',
                                '3 - 4 triệu',
                                '4 - 5 triệu',
                                '5 - 6 triệu',
                                '6 - 7 triệu',
                                'Trên 7 triệu',
                            ];
                        @endphp
                        @for ($i = 0; $i < 8; $i++)
                            @php
                                $from = $i * 1000000;
                                $to = ($i + 1) * 1000000;
                                $value = $i === 7 ? "$from-" : "$from-$to";
                            @endphp
                            <li>
                                <input type="checkbox" class="hidden-checkbox" name="price"
                                    id="price-{{ $i }}" value="{{ $value }}"
                                    {{ request('price') == $value ? 'checked' : '' }}>
                                <label class="custom-label" for="price-{{ $i }}">
                                    {{ $labels[$i] }}
                                </label>
                            </li>
                        @endfor
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>


@push('scripts')
    <script>
        $(document).ready(function() {
            $('.hidden-checkbox').change(function() {
                let query = new URLSearchParams(window.location.search);
                let url = window.location.href.split('?')[0];
                let params = query.toString() ? '?' + query.toString() : '';

                let attribute = $(this).attr('name');
                let value = $(this).val();

                if ($(this).is(':checked')) {
                    query.set(attribute, value);
                } else {
                    query.delete(attribute);
                }

                window.location.href = url + '?' + query.toString();
            });
        })
    </script>
@endpush
