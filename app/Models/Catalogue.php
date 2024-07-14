<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Catalogue extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'name',
        'parent_id',
        'slug',
        'description',
        'is_active',
        'deleted',
    ];
    public static function recursive($data, $parents = 0, $level = 1, &$listCategory)
    {

        //Kiểm tra xem có dữ liệu hay không
        //Nếu có thì tiếp tục xử lý
        if (count($data)) {
            foreach ($data as $key => $value) {
                //Kiểm tra xem parent_id trên cơ sở dữ liệu có bằng với biến parents được truyền vào hàm hay không
                if ($value->parent_id == $parents) {
                    //Nếu đúng thì nghĩa là danh mục này là một danh mục con của danh mục cha hiện tại 
                    //Hàm sẽ gắn level thông qua biến level được cho 
                    $value->level = $level;
                    //Sau khi gán cấp độ thì dữ liệu sẽ được thêm vào mảng $listCategory
                    $listCategory[] = $value;
                    //Sau khi đã thêm dữ liệu trươc đó vào r thì sẽ tiến hành xóa phần tử đã duyệt khỏi mảng $data để tránh trùng lặp
                    unset($data[$key]);
                    //Sau đó tiếp tục gọi hàm đệ quy với dữ liệu còn lại và parent_id mới
                    $parent = $value->id;
                    self::recursive($data, $parent, $level + 1, $listCategory);
                }
            }
        }
    }
    protected $casts = [
        'is_active' => 'boolean',
    ];
    public function parent()
    {
        return $this->belongsTo(Catalogue::class, 'parent_id');
    }

    // Relationship to get the subcategories
    public function children()
    {
        return $this->hasMany(Catalogue::class, 'parent_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
