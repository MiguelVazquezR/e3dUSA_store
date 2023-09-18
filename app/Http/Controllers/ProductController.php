<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function filter(Request $request)
    {

        $query = Product::query();
        // ----------------- category ------------------------  
        if ($request->key_ring === true) {
            $query->orWhere('category', 'Llaveros');
        }
        if ($request->emblem === true) {
            $query->orWhere('category', 'Emblemas');
        }
        if ($request->plate_holder === true) {
            $query->orWhere('category', 'Portaplacas');
        }
        if ($request->mats === true) {
            $query->orWhere('category', 'Tapetes');
        }
        if ($request->perfumers === true) {
            $query->orWhere('category', 'Perfumeros');
        }
        if ($request->parasols === true) {
            $query->orWhere('category', 'Parasoles');
        }
        if ($request->discounts === true) {
            $query->whereNotNull('discount');
        }
        //  ---------------------- brand --------------------   
        if ($request->honda === true) {
            $query->orWhere('brand', 'Honda');
        }
        if ($request->bmw === true) {
            $query->orWhere('brand', 'BMW');
        }
        if ($request->dalton === true) {
            $query->orWhere('brand', 'Dalton');
        }
        if ($request->mercedez === true) {
            $query->orWhere('brand', 'Mercedez');
        }
        if ($request->bosch === true) {
            $query->orWhere('brand', 'Bosch');
        }
        // ----------------------- material -----------------------   
        if ($request->aluminum === true) {
            $query->orWhere('material', 'Aluminio');
        }
        if ($request->abs === true) {
            $query->orWhere('material', 'Abs');
        }
        if ($request->metal === true) {
            $query->orWhere('material', 'Metal');
        }
        if ($request->resin === true) {
            $query->orWhere('material', 'Resina');
        }
        if ($request->rubber === true) {
            $query->orWhere('material', 'Caucho');
        }
        if ($request->textile === true) {
            $query->orWhere('material', 'Textil');
        }
        if ($request->other === true) {
            $query->orWhere('material', 'Otro');
        }
        // ------------------------ color ------------------------   
        //         if ($request->color')) {
        //             $query->orWhere('color', $request->input('color'));
        //         }

        $filtered_products = ProductResource::collection($query->with('media')->where('is_active', true)->get());

        //    dd($filtered_products);

        return response()->json(['items' => $filtered_products]);
    }


    public function index()
    {
        $products = ProductResource::collection(Product::with('media')->where('is_active', true)->latest()->get());

        // return $products;
        return inertia('Product/Index', compact('products'));
    }

    public function indexAdmin()
    {
        $products = Product::latest()->get();

        return inertia('Product/IndexAdmin', compact('products'));
    }


    public function create()
    {
        return inertia('Product/Create');
    }


    public function store(Request $request)
    {
        $discount_validations = 'nullable';

        if ($request->has_discount) {
            if ($request->is_percentage === true) {
                $discount_validations = 'required|numeric|min:0|max:100';
            } else {
                $discount_validations = 'required|numeric|min:0|max:' . $request->price;
            }
        }

        $validated = $request->validate([
            'name' => 'required|string',
            'category' => 'required|string',
            'material' => 'required|string',
            'brand' => 'required|string',
            'model' => 'nullable|string',
            'colors' => 'nullable|array',
            'part_number' => 'required|string',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'is_percentage' => $request->has_discount ? 'required' : 'nullable',
            'stock' => 'required|numeric|min:0',
            'discount' => $discount_validations,
            'features' => 'nullable',
        ]);


        // Crea el registro del producto después de la validación
        $product = Product::create($validated);

        // Guarda la imagen de portada
        if ($request->hasFile('media')) {
            $product->addMedia($request->file('media'))
                ->toMediaCollection('cover'); // Cambia 'images' por tu nombre de colección deseado
        }

        // Guarda las imágenes adicionales
        for ($i = 1; $i <= 3; $i++) {
            $inputName = "media$i";
            if ($request->hasFile($inputName)) {
                $product->addMedia($request->file($inputName))
                    ->toMediaCollection("image$i"); // Cambia 'images1', 'images2', 'images3' por tus nombres de colección deseados
            }
        }

        return to_route('products.indexAdmin'); // Redirige a la página adecuada después de crear el producto
    }


    public function show($product_id)
    {

        $product = Product::with('media')->where('id', $product_id)->first();
        $similar_products = Product::with('media')->where('category', $product->category)->get();
        // return $product;
        return inertia('Product/Show', compact('product', 'similar_products'));
    }


    public function edit(Product $product)
    {
        $images = [
            $product->getMedia('cover'),
            $product->getMedia('image1'),
            $product->getMedia('image2'),
            $product->getMedia('image3'),
        ];

        return inertia('Product/Edit', compact('product', 'images'));
    }


    public function update(Request $request, Product $product)
    {
        //
    }


    public function destroy(Product $product)
    {
        //
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        // Realiza la búsqueda en la base de datos
        $results = Product::where('name', 'like', "%$query%")->get()->take(7);

        return response()->json($results);
    }
}
