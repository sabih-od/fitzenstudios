@extends('layouts.trainer')
@section('page-title')
{{ $performance == null ? 'Add ' : 'Update '}}Performance
@endsection
@section('style')
    <style>
   
      
    </style>
@endsection
@section('content')
<main>
    <div class="content-wrap">
        <div class="row">
            <div class="col-md-12">

                <h2 class="secHeading">{{ $performance == null ? 'Add ' : 'Update '}}Performance</h2>
            </div>
            <div class="col-md-12">
                <div class="prf-detailwrap">
                    <form action="{{ url('trainer/add-performance') }}" method="POST" >
                        @csrf
                        <input type="hidden" name="session_id" value="{{ $id }}">
                        <div class="row">
                            <div class="col-md-10 mt-3">
                                <h3>Generic</h3><br>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="">Time Login</label>
                                    <input type="text" name="time_login" class="form-control" value="{{ $performance->time_login ?? ''}}" maxlength="20">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="">Time Logout</label>
                                    <input type="text" name="time_logout" class="form-control" value="{{ $performance->time_logout ?? ''}}" maxlength="20">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="">Pre workout Meal</label>
                                    <input type="text" name="per_workout_meal" class="form-control" value="{{ $performance->per_workout_meal ?? ''}}" maxlength="50">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="">Hours of Sleep the Previous Day</label>
                                    <input type="text" name="hours_of_sleep_prev_day" class="form-control" value="{{ $performance->hours_of_sleep_prev_day ?? ''}}" maxlength="50">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="">Step Count the Previous Day</label>
                                    <input type="text" name="step_count_prev_day"  class="form-control" value="{{ $performance->step_count_prev_day ?? ''}}" maxlength="50">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="">Any activity done the Previous Day which Could Hamper Recovery</label>
                                    <input type="text" name="prev_day_activity"  class="form-control" value="{{ $performance->prev_day_activity ?? ''}}" maxlength="50">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="">Calorie Count During the Session </label>
                                    <input type="text"  name="calories_count_during_session" class="form-control" value="{{ $performance->calories_count_during_session ?? ''}}" maxlength="50">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="">Any aches or Pains to be Mindful of</label>
                                    <input type="text"  name="any_aches_or_pains" class="form-control" value="{{ $performance->any_aches_or_pains ?? ''}}" maxlength="50">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="">Mood and Energy level</label>
                                    <input type="text" name="mood_and_energy_level" class="form-control" value="{{ $performance->mood_and_energy_level ?? ''}}" maxlength="50">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="">Average Heart Rate during the Session</label>
                                    <input type="text" name="avg_heart_rate_during_session" class="form-control" value="{{ $performance->avg_heart_rate_during_session ?? ''}}" maxlength="50">
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <h3>Mobility &amp; Stretches</h3><br>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="">Time Taken</label>
                                    <input type="text" maxlength="50" name="time_taken" class="form-control"  value="{{ $performance->time_taken ?? ''}}">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="">Any Difficulty Noticed</label>
                                    <input type="text" maxlength="60" name="any_difficulty_noticed" class="form-control"  value="{{ $performance->any_difficulty_noticed ?? ''}}">
                                </div>
                            </div>
                            <div class="col-md-10 mt-3">
                                <h3>Core &amp; Balance Circuit Training </h3><br>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="">No of Reps for Each Workout</label>
                                    <input type="text" maxlength="50" name="no_of_reps_for_each_workout" class="form-control"   value="{{ $performance->no_of_reps_for_each_workout ?? ''}}">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="">Number of Laps</label>
                                    <input type="text" maxlength="50" name="no_of_laps" class="form-control"   value="{{ $performance->no_of_laps ?? ''}}">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="">Whether Completed within the Stipulated time </label>
                                    <input type="text" name="stipulated_time" maxlength="50" class="form-control"   value="{{ $performance->stipulated_time ?? ''}}">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="">Any Difficulty Noticed</label>
                                    <input type="text" name="difficulty" maxlength="60" class="form-control"   value="{{ $performance->difficulty ?? ''}}">
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="">Additional Comments</label>
                                    <textarea name="additional_comments" class="form-control">{{ $performance->additional_comments ?? ''}}</textarea>
                                </div>
                            </div>

                            <div class="col-md-10 mt-3">
                                <h3>Speed/Agility Workout</h3><br>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="">No of Reps for Each Workout</label>
                                    <input type="text" name="agility_workout" class="form-control"   value="{{ $performance->agility_workout ?? ''}}">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="">Number of Laps</label>
                                    <input type="text" maxlength="50" name="agility_no_of_laps" class="form-control"   value="{{ $performance->agility_no_of_laps ?? ''}}"> 
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="">Whether Completed within the Stipulated time </label>
                                    <input type="text" maxlength="50" name="agility_stipulated_time" class="form-control"   value="{{ $performance->agility_stipulated_time ?? ''}}">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="">Any Difficulty Noticed</label>
                                    <input type="text" maxlength="50" name="agility_difficulty_noticed" class="form-control"   value="{{ $performance->agility_difficulty_noticed ?? ''}}">
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="">Additional Comments</label>
                                    <textarea name="agility_add_comments" class="form-control">{{ $performance->agility_add_comments ?? ''}}</textarea>
                                </div>
                            </div>

                            <div class="col-md-10 mt-3">
                                <h3>Resistance Training </h3><br>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="">No of Reps for Each Workout</label>
                                    <input type="text"  name="resistance_workout" class="form-control" value="{{ $performance->resistance_workout ?? ''}}">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="">Number of Laps</label>
                                    <input type="text"  name="resistance_no_of_laps" class="form-control" value="{{ $performance->resistance_no_of_laps ?? ''}}">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="">Whether Completed within the Stipulated time </label>
                                    <input type="text"  name="resistance_stipulated_time" class="form-control" value="{{ $performance->resistance_stipulated_time ?? ''}}">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="">Any Difficulty Noticed</label>
                                    <input type="text"  name="resistance_difficulty_noticed" class="form-control" value="{{ $performance->resistance_difficulty_noticed ?? ''}}">
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="">Additional Comments</label>
                                    <textarea  class="form-control" name="resistance_add_comments">{{ $performance->resistance_add_comments ?? ''}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="">The Denomination of the Weights used</label>
                                    <input type="text" name="denomination" class="form-control" value="{{ $performance->denomination ?? ''}}">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="">What Kind of Props were used for the Workouts</label>
                                    <input type="text" maxlength="50" name="type_of_props" class="form-control" value="{{ $performance->type_of_props ?? ''}}">
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="">Whether Completed within the Stipulated time </label>
                                    <input type="text" maxlength="50" name="denomination_stipulated_time" class="form-control" value="{{ $performance->denomination_stipulated_time ?? ''}}">
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="">Additional Comments</label>
                                    <textarea class="form-control" name="denomination_add_comments">{{ $performance->denomination_add_comments ?? ''}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-10 mt-3">
                                <h3>Cool Down Stretches</h3><br>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="">Time Taken</label>
                                    <input type="text" maxlength="50" class="form-control" name="stretches_time_taken" value="{{ $performance->stretches_time_taken ?? ''}}">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="">Any Difficulty Noticed</label>
                                    <input type="text" maxlength="50" class="form-control" name="stretches_difficulty_noticed" value="{{ $performance->stretches_difficulty_noticed ?? ''}}">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <button type="submit" class="btnStyle">{{ $performance == null ? 'Add ' : 'Update '}}PERFORMANCE</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('js')
  
@endsection