<div class="form-group">
    <div class="row" style="margin-bottom: 10px;">
        <div class="col-md-12">
            <label>Requirement Name</label>
            <input type="text" class="form-control input-text-modal requirement_name"
                   name="requirement_name"
                   id="" placeholder="" value="{{ old('requirement_name', isset($requirement) ? $requirement->name : '')}}">
        </div>
        <div class="col-md-12">
            <label>Description:</label>
            <textarea rows="4" cols="50" name="requirement_description"
                      class="form-control input-text-modal" id="description">{{ old('requirement_name', isset($requirement) ? $requirement->description : '')}}</textarea>

        </div>
        <div class="col-md-12 assignee">
            <label>Assingees:</label>
            <select class="form-control input-text-modal selectpicker"
                    name="assignee[]"
                    multiple>
                @foreach($user as $u)
                    <option
                            @if(isset($requirement))
                                @foreach($requirement->assignees as $as)
                                @if($u->userid  == $as->userid)
                                selected
                                @endif
                                @endforeach
                            @endif
                                value="{{$u->users->id}}">{{$u->users->first_name}} {{$u->users->last_name}} @if(isset($u->users->jobtitles))
                                (<i>{{$u->users->jobtitles->name}}</i>) @endif</option>

                @endforeach
            </select>
        </div>
    </div>
</div>