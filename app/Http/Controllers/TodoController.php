<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
class TodoController extends Controller
{
    public function index()
    {
        $products= Todo::all();
        return view('products.index',['products'=>$products]);
        
    }
    public function create()
    {
        return view('products.create');
    }
    public function store(Request $request){
        $data = $request->validate([
            'task' => 'required',
            'value' => 'required|numeric',
            'description' => 'nullable'
        ]);
    
        $newProduct = Todo::create($data);
        return redirect(route('product.index'));
    }
    public function edit(Todo $product)
    {
        return view('products.edit',['product'=>$product]);
    }
    public function update(Todo $product, Request $request)
    {
        $data = $request->validate([
            'task' => 'required',
            'value' => 'required|numeric',
            'description' => 'nullable'
        ]);

        $product->update($data);
        return redirect(route('product.index'))->with('success','Product Updated Successfully');
    }
    public function destroy(Todo $product)
    {
       $product->delete();
       return redirect(route('product.index'))->with('success','Product Deleted Successfully');
    }

    public function adding(Request $request)
    {
       $items=new Todo();
       $items->task = $request->task;
       $items->value = $request->value;
       $items->description = $request->description;
       $items->save();

       return response()->json('Added Successfully');
    }
    public function edited(Request $request){
        $item = Todo::findOrFail($request->id);
     
        $item->task = $request->task;
        $item->value = $request->value;
        $item->description = $request->description;
        $item->update();
     
        return response()->json('Updated Successfully');
     }
     public function deleted(Request $request){
    $item = Todo::findOrFail($request->id)->delete();
    return response()->json('Deleted Successfully');
     }
     public function getData(){
        $items = Todo::all();
        return response()->json($items);
         }
         public function search(Request $request)
         {
             $query = $request->input('query');
             $products = Todo::where('task', 'LIKE', "%{$query}%")->get();
             return view('search_results', compact('products'));
         }
         public function suggestions(Request $request) {
            $query = $request->get('query');
            $suggestions = Todo::where('task', 'LIKE', "%{$query}%")
                ->pluck('task')
                ->take(5);
    
            return response()->json($suggestions);
        }
        public function indexed()
        {
            $products = Todo::all();
            return view('products.index', ['products' => $products]); 
        }
        public function welcome()
{
    $products = Todo::all(); // Fetch all products or adjust query as needed
    return view('welcome', compact('products'));
}
}
