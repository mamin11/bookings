@extends('layouts.home')
@section('content')
<div class="container">
    <p class="display-4 text-center">EVALUATION QUESTIONNAIRE</p>
    <hr>
    <div class="row">
        <div class="col">
            <h4>Please score on a scale of 1-5. 5 being most likely and 1 being least likely</h4>
            <form action="/evaluation" method="POST">
                @csrf

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session()->has('message'))
            <div class="alert alert-success">{{ session()->get('message') }}</div>
            @endif

            <div class="form-group mt-4"><p name="question1" style="font-size: 2rem">How easy was it to use the application? *</p></div>
            @for ($i = 1; $i <= 5; $i++)
            <div class="form-check">
                    <input class="form-check-input" type="radio" name="question1answer" id="question1answer{{$i}}" @if(old('question1answer')  == $i)  checked @endif value="{{ $i}}">
                    <label  style="font-size: 1.2rem" class="form-check-label" for="question1answer{{$i}}">
                    {{$i}}
                    </label>
                </div>
            @endfor

            <div class="form-group mt-4"><p style="font-size: 2rem">How likely is it that you could navigate through the application with ease? *</p></div>
            @for ($i = 1; $i <= 5; $i++)
            <div class="form-check">
                    <input class="form-check-input" type="radio" name="question2answer" id="question2answer{{$i}}"  @if(old('question2answer')  == $i)  checked @endif value="{{$i}}">
                    <label  style="font-size: 1.2rem" class="form-check-label" for="question2answer{{$i}}">
                    {{$i}}
                    </label>
                </div>
            @endfor

            <div class="form-group mt-4"><p style="font-size: 2rem">How true is it that the user knew where they were on the application? *</p></div>
            @for ($i = 1; $i <= 5; $i++)
            <div class="form-check">
                    <input class="form-check-input" type="radio" name="question3answer" id="question3answer{{$i}}" @if(old('question3answer')  == $i)  checked @endif value="{{ $i}}">
                    <label  style="font-size: 1.2rem" class="form-check-label" for="question3answer{{$i}}">
                    {{$i}}
                    </label>
                </div>
            @endfor

            <div class="form-group mt-4"><p style="font-size: 2rem">Colours and fonts were consistent through application? *</p></div>
            @for ($i = 1; $i <= 5; $i++)
            <div class="form-check">
                    <input class="form-check-input" type="radio" name="question4answer" id="question4answer{{$i}}" @if(old('question4answer')  == $i)  checked @endif value="{{ $i}}">
                    <label  style="font-size: 1.2rem" class="form-check-label" for="question4answer{{$i}}">
                    {{$i}}
                    </label>
                </div>
            @endfor

            <div class="form-group mt-4"><p style="font-size: 2rem">The website design was aesthetically pleasing *</p></div>
            @for ($i = 1; $i <= 5; $i++)
            <div class="form-check">
                    <input class="form-check-input" type="radio" name="question5answer" id="question5answer{{$i}}" @if(old('question5answer')  == $i)  checked @endif value="{{ $i}}">
                    <label  style="font-size: 1.2rem" class="form-check-label" for="question5answer{{$i}}">
                    {{$i}}
                    </label>
                </div>
            @endfor

            <div class="form-group mt-4"><p style="font-size: 2rem">On each page I can see the main feature without distractions. *</p></div>
            @for ($i = 1; $i <= 5; $i++)
            <div class="form-check">
                    <input class="form-check-input" type="radio" name="question6answer" id="question6answer{{$i}}" @if(old('question6answer')  == $i)  checked @endif value="{{$i}}">
                    <label  style="font-size: 1.2rem" class="form-check-label" for="question6answer{{$i}}">
                    {{$i}}
                    </label>
                </div>
            @endfor

            <div class="form-group mt-4"><p style="font-size: 2rem">The user gets relevant error messages? *</p></div>
            @for ($i = 1; $i <= 5; $i++)
            <div class="form-check">
                    <input class="form-check-input" type="radio" name="question7answer" id="question7answer{{$i}}" @if(old('question7answer')  == $i)  checked @endif value="{{$i}}">
                    <label  style="font-size: 1.2rem" class="form-check-label" for="question7answer{{$i}}">
                    {{$i}}
                    </label>
                </div>
            @endfor

            <div class="form-group mt-4"><p style="font-size: 2rem">The user cannot perform anything they are not authorised to do? *</p></div>
            @for ($i = 1; $i <= 5; $i++)
            <div class="form-check">
                    <input class="form-check-input" type="radio" name="question8answer" id="question8answer{{$i}}" @if(old('question8answer')  == $i)  checked @endif value="{{$i}}">
                    <label  style="font-size: 1.2rem" class="form-check-label" for="question8answer{{$i}}">
                    {{$i}}
                    </label>
                </div>
            @endfor

            <div class="form-group mt-4"><p style="font-size: 2rem">User can start and complete a purchase process? *</p></div>
            @for ($i = 1; $i <= 5; $i++)
            <div class="form-check">
                    <input class="form-check-input" type="radio" name="question9answer" id="question9answer{{$i}}" @if(old('question9answer')  == $i)  checked @endif value="{{$i}}">
                    <label  style="font-size: 1.2rem" class="form-check-label" for="question9answer{{$i}}">
                    {{$i}}
                    </label>
                </div>
            @endfor

            <div class="form-group mt-4"><p style="font-size: 2rem">The user could message staff or other members with ease? *</p></div>
            @for ($i = 1; $i <= 5; $i++)
            <div class="form-check">
                    <input class="form-check-input" type="radio" name="question10answer" id="question10answer{{$i}}" @if(old('question10answer')  == $i)  checked @endif value="{{ $i}}">
                    <label  style="font-size: 1.2rem" class="form-check-label" for="question10answer{{$i}}">
                    {{$i}}
                    </label>
                </div>
            @endfor

            <div class="form-group mt-4"><p style="font-size: 2rem">The application provides all the features I would expect as a [ user group ] *</p></div>
            @for ($i = 1; $i <= 5; $i++)
            <div class="form-check">
                    <input class="form-check-input" type="radio" name="question11answer" id="question11answer{{$i}}" @if(old('question11answer')  == $i)  checked @endif value="{{ $i}}">
                    <label  style="font-size: 1.2rem" class="form-check-label" for="question11answer{{$i}}">
                    {{$i}}
                    </label>
                </div>
            @endfor

            <div class="form-group mt-4">
                <p style="font-size: 2rem">What are the strengths of the application?</p>
                <textarea class="form-control" name="strengths" id="strengths" rows="5" style="min-height: 250px">{{old('strengths')}}</textarea>
            </div>

            <div class="form-group mt-4">
                <p style="font-size: 2rem">What are the weaknesses of the application?</p>
                <textarea class="form-control" name="weaknesses" id="weaknesses" rows="5" style="min-height: 250px">{{old('weaknesses')}}</textarea>
            </div>

            <div class="form-group mt-4">
                <p style="font-size: 2rem">Are there any improvements that could be made?</p>
                <textarea class="form-control" name="improvements" id="improvements" rows="5" style="min-height: 250px">{{old('improvements')}}</textarea>
            </div>

            <div class="form-group mt-4 mt-4 d-flex justify-content-center">
                <button type="submit" class="btn btn-lg btn-dark">Submit</button>
            </div>
        </form>
        </div>
    </div>
</div>
@endsection