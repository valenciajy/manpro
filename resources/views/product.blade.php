@extends('template.layout')

@section('section')

<div class="container mx-auto py-8">
    
    <!-- Breadcrumb -->
    <nav class="text-gray-600 text-sm mb-6">
        <a href="/home" class="text-gray-500 hover:text-gray-900">Home</a> >
        <a href="/shop" class="text-gray-500 hover:text-gray-900">Shop</a> >
        <span class="text-gray-900">{{ $produk->nama_produk }}</span>
    </nav>

    <!-- Product Section -->
    <div class="flex flex-col lg:flex-row lg:space-x-12">
        <!-- Product Images -->
        <div class="lg:w-1/2">
            <img src="{{ $produk->image }}" alt="{{ $produk->nama_produk }}" class="w-full rounded-lg shadow-lg mb-4">
        </div>

        <!-- Product Details -->
        <div class="lg:w-1/2">
            <h1 class="text-3xl font-bold mb-2" id="product-name">{{ $produk->nama_produk }}</h1>
            <p id="product-price" class="text-lg text-gray-600 mb-4">Rp. {{ number_format($produk->harga, 0, ',', '.') }}</p>
            
            <!-- Star Ratings -->
            <div class="flex items-center mb-4">
                <div class="text-yellow-500 space-x-1">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <p class="ml-2 text-sm text-gray-500">(5 customer reviews)</p>
            </div>

            <!-- Merk and Jenis -->
            <form id="addToCartForm" action="{{ route('cart.add', ['id' => $produk->id_produk]) }}" method="POST">
                @csrf

                <div class="flex items-center space-x-4 mb-4">
                    <div>
                        <label for="merk" class="block text-sm font-medium">Merk:</label>
                        <select id="merk" name="merk" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none">
                            <option value="">Pilih...</option>
                            @foreach($produkByMerk as $merk => $listJenis)
                                <option value="{{ $merk }}">
                                    {{ $merk }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="jenis" class="block text-sm font-medium">Jenis:</label>
                        <select id="jenis" name="jenis" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none">
                        </select>
                    </div>
                </div>

                <!-- Add to Cart Button -->
                <!-- Hidden input to pass the product ID and quantity -->
                <input type="hidden" name="product_id" value="{{ $produk->id_produk }}">
                <input type="hidden" id="productQuantity" name="quantity" value="1">
                
                <!-- Quantity Input -->
                <div class="flex items-center mb-6">
                    <input type="number" id="quantity" name="quantity" value="1" min="1" class="w-16 border text-center">
                </div>
                
                <!-- Submit Button -->
                <button type="submit" class="mt-4 py-2 px-6 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Add to Cart</button>
                
                @if ($errors->any())
                    <div class="mt-2 bg-red-500 text-sm text-white rounded-lg p-4" role="alert" tabindex="-1" aria-labelledby="hs-solid-color-danger-label">
                        <span id="hs-solid-color-danger-label" class="font-bold">Error</span>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            </form>

            <!-- Product Description -->
            <h2 class="text-xl font-semibold mb-2">Product Description</h2>
            <p class="text-gray-600 mb-6">
                - This is a sample product description that provides information about the product's features and specifications.
            </p>
        </div>
    </div>

    <!-- Additional Information -->
    <div class="mt-12">
        <h2 class="text-2xl font-bold mb-4">Additional Information</h2>
        <table class="table-auto w-full text-left text-gray-600">
            <tbody>
                <tr>
                    <th class="py-2">Material</th>
                    <td class="py-2">Cotton</td> <!-- Placeholder material -->
                </tr>
                <tr>
                    <th class="py-2">Weight</th>
                    <td class="py-2">200g</td> <!-- Placeholder weight -->
                </tr>
                <tr>
                    <th class="py-2">Dimensions</th>
                    <td class="py-2">10 x 10 x 10 cm</td> <!-- Placeholder dimensions -->
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    const produkByMerk = @json($produkByMerk);
    
    $(document).ready(function() {
        // Update the form's quantity value when the user changes the quantity input field
        $('#quantity').on('input', function() {
            var quantity = $(this).val();
            $('#productQuantity').val(quantity);
        });

        $('#merk').on('change', function(e) {
            const merk = $('#merk').val();

            $('#jenis').html('');

            if (merk == "") return;

            const jenisForMerk = produkByMerk[merk];
    
            for (const x of jenisForMerk) {
                $('#jenis').append(`
                    <option value="${x.jenis}">${x.jenis}</option>
                `)
            }
        });
    });


</script>