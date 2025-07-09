<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\product;
use App\Models\state;
use App\Models\city;
use Illuminate\Support\Facades\Http;
use Automattic\WooCommerce\Client;

class productcontroller extends Controller
{
    public function addproduct(Request $request)
    {   

        if ($request->isMethod('get')) {

            $route =route('add.product');

            $state = state::all();

            $city = city::all();

            return view('pages.admin.product.addproduct',compact('state','city','route'));

        }
        elseif($request->isMethod('post'))
        {
            $product = new product;

            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->image_url = $request->image_url;
            $product->save();

             $wooResponse = $this->createWooProduct($product);
            if (isset($wooResponse['id'])) {
                $product->woocommerce_id = $wooResponse['id'];
                $product->save();
            }
            
            return redirect()->route('view.product')->with('success','product created successfully');

        }

    }

    private function createWooProduct($product)
    {
        $url = geturl() . '/wp-json/wc/v3/products';

        $key = getWooKey();
        $secret = getWooSecret();

    

        $response = Http::withBasicAuth($key, $secret)->post($url, [
            'name' => $product->name,
            'type' => 'simple',
            'regular_price' => (string) $product->price,
            'description' => $product->description,
            'images' => [
                ['src' => $product->image_url]
            ],
        ]);

        if ($response->successful()) {
            return $response->json();
        } else {
            dd($response->body()); // for debugging
        }
    }


    public function viewproduct()
    {
        $product = product::orderBy('created_at', 'desc')->paginate(25);

        return view('pages.admin.product.viewproduct',compact('product'));

    }

    public function productdetail($id){

        $product = product::find($id);

        return view('pages.admin.product.productdetail');

    }

    public function fetchcity($id)
    {
       $city = city::where('state_id',$id)->pluck('name','id');

       return response()->json($city);
        
    }

    public function ajax_validate(Request $request)
    {  
        if($request->cid)
        {
            return validate_form($request, $request->cid);
        }else{

            return validate_form($request);
        }
        
       
    }

    public function opencontact(Request $request,$id)
    {
        $product = product::find($id);

        $parameter = $request->para;

        if($parameter =='contact'){

                return view('pages.admin.model.opendetail',compact('product','parameter')); 

        }elseif($parameter =="pin"){

                return view('pages.admin.model.opendetail',compact('product','parameter')); 

        }


    }

    public function editproduct(Request $request ,$id)
    {
        
             if ($request->isMethod('get')) {

                    $product = product::find($id);

                     $state = state::all();

                    $city = city::all();

                     $route = route('edit.product', [$id]);

                    return view('pages.admin.product.addproduct',compact('state','city','product','route'));



             }else{

                    $product = product::find($id);

                    $product->name = $request->name;
                    $product->description = $request->description;
                    $product->price = $request->price;
                    $product->image_url = $request->image_url;
                    $product->save();

                     if ($product->woocommerce_id) {
                        $url = geturl() . '/wp-json/wc/v3/products/' . $product->woocommerce_id;
                        $key = getWooKey();
                        $secret = getWooSecret();

                    $response = Http::withBasicAuth($key, $secret)->put($url, [
                        'name' => $product->name,
                        'regular_price' => (string) $product->price,
                        'description' => $product->description,
                        'images' => [
                            ['src' => $product->image_url]
                        ],
                    ]);


                    return redirect()->route('view.product')->with('success','product updated successfully');

             }

    }

}

    public function delete_product($id)
{
    $product = product::find($id);

    if ($product) {
        if ($product->woocommerce_id) {
            $url = geturl() . '/wp-json/wc/v3/products/' . $product->woocommerce_id;
            $key = getWooKey();
            $secret = getWooSecret();

            $response = Http::withBasicAuth($key, $secret)->delete($url, [
                'force' => true
            ]);

            if (!$response->successful()) {
                \Log::error('WooCommerce delete failed: ' . $response->body());
            }
        }

        $product->delete();
    }

    return redirect()->route('view.product')->with('success', 'Product deleted successfully');
}
  
    
    public function product_chngestatus($id)
    {
         $product = product::find($id);
         
         if($product->status =="1")
         {  
            $product->status =0;
            $product->save();
         }else{
            $product->status =1;
            $product->save();
         }

          return redirect()->route('view.product')->with('success','product status chnaged successfully');

    }

    public function sync_product()
    {

         $url = geturl() . '/wp-json/wc/v3/products';
    $key = getWooKey();
    $secret = getWooSecret();

    $response = Http::withBasicAuth($key, $secret)->get($url);

    if (!$response->successful()) {
        return back()->with('error', 'Failed to fetch products from WooCommerce.');
    }

    $wooProducts = $response->json();

    $added = 0;
    $skipped = 0;

    foreach ($wooProducts as $wooProduct) {
    
        $existing = \App\Models\product::where('woocommerce_id', $wooProduct['id'])->first();

        if ($existing) {
            $skipped++;
            continue;
        }

        \App\Models\product::create([
            'name' => $wooProduct['name'],
            'description' => $wooProduct['description'] ?? '',
            'price' => $wooProduct['regular_price'] ?? 0,
            'image_url' => $wooProduct['images'][0]['src'] ?? null,
            'woocommerce_id' => $wooProduct['id'],
        ]);

        $added++;
    }

    return back()->with('success', "Sync completed: $added added, $skipped skipped.");



    }



   
}
