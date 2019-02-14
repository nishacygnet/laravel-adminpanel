<?php

namespace App\Repositories\Backend\Student;

use DB;
use Carbon\Carbon;
use App\Models\Student\Student;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


/**
 * Class StudentRepository.
 */
class StudentRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Student::class;
     protected $upload_path;
    /**
     * This method is used by Table Controller
     * For getting the table data to show in
     * the grid
     * @return mixed
     */
    protected $storage;

    public function __construct()
    {
        $this->upload_path = 'img'.DIRECTORY_SEPARATOR.'blog'.DIRECTORY_SEPARATOR;
        $this->storage = Storage::disk('public');
    }

    public function getForDataTable()
    {
        return $this->query()
            ->select([
                config('module.students.table').'.id',
                config('module.students.table').'.first_name',
                config('module.students.table').'.last_name',
                config('module.students.table').'.gender',
                config('module.students.table').'.created_at',
                config('module.students.table').'.updated_at',
            ])->orderBy('id','desc');
    }

    /**
     * For Creating the respective model in storage
     *
     * @param array $input
     * @throws GeneralException
     * @return bool
     */
    public function create(array $input)
    {
        $input = $this->uploadImage($input);
        if (Student::create($input)) {
            return true;
        }
        throw new GeneralException(trans('exceptions.backend.students.create_error'));
    }

    /**
     * For updating the respective Model in storage
     *
     * @param Student $student
     * @param  $input
     * @throws GeneralException
     * return bool
     */
    public function update(Student $student, array $input)
    {
         if (array_key_exists('profile_picture', $input)) {
            $this->deleteOldFile($student);
            $input = $this->uploadImage($input);
        }

    	if ($student->update($input))
            return true;

        throw new GeneralException(trans('exceptions.backend.students.update_error'));
    }

    /**
     * For deleting the respective model from storage
     *
     * @param Student $student
     * @throws GeneralException
     * @return bool
     */
    public function delete(Student $student)
    {
        if ($student->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.students.delete_error'));
    }


    public function uploadImage($input)
    {

        if(empty($input['profile_picture'])) {
            return $input;
        }

        $avatar = $input['profile_picture'];

        if (isset($input['profile_picture']) && !empty($input['profile_picture'])) {
            $fileName = time().$avatar->getClientOriginalName();

            $this->storage->put($this->upload_path.$fileName, file_get_contents($avatar->getRealPath()));

            $input = array_merge($input, ['profile_picture' => $fileName]);

            return $input;
        }
    }

    /**
     * Destroy Old Image.
     *
     * @param int $id
     */
    public function deleteOldFile($model)
    {
        $fileName = $model->profile_picture;

        return $this->storage->delete($this->upload_path.$fileName);
    }
}
