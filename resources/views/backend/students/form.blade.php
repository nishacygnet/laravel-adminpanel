<div class="box-body">
    <div class="form-group">
       {{ Form::label('first_name', trans('validation.attributes.backend.student.first_name'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
           {{ Form::text('first_name', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.student.first_name'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form-group-->

    <div class="form-group">
       {{ Form::label('last_name', trans('validation.attributes.backend.student.last_name'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
           {{ Form::text('last_name', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.student.last_name'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form-group-->

    <div class="form-group">
       {{ Form::label('gender', trans('validation.attributes.backend.student.gender'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
        <div>
            <label for="gender-male" class="control control--radio">
                            <input type="radio" @if(@$students->gender == 'male' || @$students->gender == '') {{ 'checked' }} @endif name="gender" value="male" id="gender-male" /> &nbsp;&nbsp; Male
                            <div class="control__indicator"></div>
            </label>
            </div>
            <div>
            <label for="gender-female" class="control control--radio">
                            <input     type="radio" @if(@$students->gender == 'female') {{ 'checked' }} @endif name="gender" value="female" id="gender-female" /> &nbsp;&nbsp; Female
                            <div class="control__indicator"></div>
            </label>
          
            </div>
           
        </div><!--col-lg-10-->
    </div><!--form-group-->

    <div class="form-group">
        {{ Form::label('hobbies', trans('validation.attributes.backend.student.hobbies'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10 mce-box">
            {{ Form::textarea('Hobbies', null, ['class' => 'form-control box-size']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('profile_picture', trans('validation.attributes.backend.student.profile_picture'), ['class' => 'col-lg-2 control-label']) }}
         @if(!empty($students->profile_picture))
            <div class="col-lg-1">
                <img src="<?php echo asset("storage/img/blog/$students->profile_picture")?>" height="80" width="80">
            </div>
            @endif
        <div class="col-lg-5 mce-box">
            <input type="file" class="form-control box-size" name="profile_picture" id="profile_picture"/>
        </div><!--col-lg-10-->
    </div><!--form control-->
    
    <div class="form-group">
        {{ Form::label('standard', trans('validation.attributes.backend.student.standard'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10 mce-box">
           {{ Form::select('standard', $standard, null, ['class' => 'form-control tags box-size client', 'placeholder' => trans('validation.attributes.backend.student.select'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->
       
</div><!--box-body-->

@section("after-scripts")
    <script type="text/javascript">
        //Put your javascript needs in here.
        //Don't forget to put `@`parent exactly after `@`section("after-scripts"),
        //if your create or edit blade contains javascript of its own
        $( document ).ready( function() {
            //Everything in here would execute after the DOM is ready to manipulated.
        });
    </script>
@endsection
