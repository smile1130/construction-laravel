<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\{Quote, Category, Item, Construction};
use Carbon\Carbon;


class QuoteController extends Controller
{
    public function newQuotePost(Request $request)
    {
        $quote = new Quote();
        $quote->user_id = auth()->user()->id;
        $quote->name = $request->name;
        $quote->request_date = Carbon::now();

        $quote->save();
        session()->flash('success', 'Você criou uma nova cotacao com sucesso.');

        return redirect()->route('additems.get', [
            'id' => $quote->id,
        ]);
    }

    public function removeQuote($id)
    {
        $quote = Quote::where('id', $id)->first();
        $quote->delete();
    }

    public function fetchQuote($id) 
    {
        $quote = Quote::where('id', $id)->first();

        return response()->json([
            'quote' => $quote,
            'category_name' => $quote->category->parent->name,
            'item_name' => $quote->category->name,
            'measurement' => $quote->category->measurement,
            'parent_id' => $quote->category->parent->id,
        ]);
    }

    public function fetchCategory($id)
    {
        $category = Category::where('id', $id)->first();
        $items = $category->subcategories();
        
        return response()->json([
            'category' => $category,
            'items' => $items,
        ]);
    }

    public function newQuote($name)
    {
        $items = Item::where('quote_id', null)->get();
        $constructions = Construction::where('user_id', auth()->user()->id)->get();
        foreach($items as $item) {
            $item->delete();
        }
        $items = Item::where('quote_id', null);
        return view('user.newquote', [
            'categories' => Category::rootCategories(),
            'quote_name' => $name,
            'items' => $items,
            'constructions' => $constructions,
        ]);
    }

    public function addItemsPost(Request $request)
    {
        $quote_name = $request->name;
        
        $quote = new Quote();
        $quote->name = $quote_name;
        $quote->save();


        $item = new Item();
        $item->construction_id = $request->construction;
        $item->category_id = $request->item;
        $item->quantity = $request->quantity;
        $item->quote_id = $qoute->id;
        $item->save();

        // $items = Item::where('quote_id', null);
        // $constructions = Construction::where('user_id', auth()->user()->id)->get();
        // return view('user.newquote', [
        //     'categories' => Category::rootCategories(),
        //     'quote_name' => $quote_name,
        //     'items' => $items,
        //     'constructions' => $constructions,
        // ]);
        return redirect()->back();
    }

}
