<div class="modal fade" id="courses-popup" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Courses</h4>
      </div>
      <div class="form-horizontal">

        <!-- <div class="modal-body">
          <div class="form-group">
            <div class="col-sm-6">
              <select class="form-control" name="academic_id" id="academic_id">
                <option> --Select Academic Year-- </option>
                {{--@foreach($academics as $academic)--}}
                <option value="{{-- $academic->academic_id --}}">{{-- $academic->academic --}}</option>
                {{--@endforeach--}}
              </select>
            </div>
            <div class="col-sm-6">
              <select class="form-control" name="program_id" id="program_id">
                <option> --Select Program-- </option>
                {{--@foreach($programs as $program)--}}
                <option value="{--{ $program->program_id --}}">{{-- $program->program --}}</option>
                {{--@endforeach--}}
              </select>
            </div>
          </div>
        </div> -->

        <div class="modal-footer">
          <div id="student-courses-show"></div>
        </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
