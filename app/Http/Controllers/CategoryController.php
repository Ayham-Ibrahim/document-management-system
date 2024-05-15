<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Traits\FollowTrait;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Resources\CategoryResource;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    use ApiResponseTrait,FollowTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $categories = Category::all();
            return $this->customeResponse(CategoryResource::collection($categories),"Done",200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null,"there is something wrong in server",500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        // try {
            $category = Category::create([
                'name' =>$request->name,
            ]);
            return $this->customeResponse(new CategoryResource($category), ' Created Successfuly', 200);
    //     } catch (\Throwable $th) {
    //         Log::error($th);
    //         return $this->customeResponse(null,"there is something wrong in server",500);
    //     }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        try {
            $category->load('documents');
            return $this->customeResponse(new CategoryResource($category), 'Done', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null,"there is something wrong in server",500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCategoryRequest $request, Category $category)
    {
        try {
            $category->name = $request->input('name') ?? $category->name;
            $category->save();
            return $this->customeResponse(new CategoryResource($category), ' Updated Successfuly', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null,"there is something wrong in server",500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return $this->customeResponse("", 'deleted successfully', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null,"there is something wrong in server",500);
        }
    }

    public function followCategory(Category $category){
        try {
            $message = $category->followToggle();
            return response()->json([
                'message' => $message,
            ]);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null,"there is something wrong in server",500);
        }
        
    }
    
}
