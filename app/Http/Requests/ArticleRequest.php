<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            //
           
            'title'=>'required|max:255',
            'description'=>'required|max:1500',
            'image'=>'nullable|mimes:jpeg,bmp,png,jpg',
            'created_by'=>'integer',
        ];
    }
    public function uploadFile(){
        $articleData = $this->validated();

        if($this->hasFile('image')){
            $file = $this->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move(public_path('upload'),$filename);
            $articleData['image'] = $filename;
            //setting the value of the user
            $articleData['created_by'] = auth()->id();
        }
        return $articleData;
    }
    
}
