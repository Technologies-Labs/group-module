<div class="add-member-popup">
    <div class="popup">
        <span class="popup-closed"><i class="icofont-close"></i></span>
        <div class="popup-meta">
            <div class="popup-head">
                <h5><i>
                        <svg class="feather feather-message-square" stroke-linejoin="round"
                            stroke-linecap="round" stroke-width="2" stroke="currentColor" fill="none"
                            viewBox="0 0 24 24" height="24" width="24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                        </svg></i> إضافة أعضاء</h5>
            </div>
            <div class="post-new">
                <form action="{{ route('group.add.member', ['group' => $group]) }}" method="post" class="c-form">
                    @csrf
                    <select name="users[]" placeholder="ادخل الاسم.." multiple>
                        @foreach ($users as $user)
                        <option  value="{{$user->name}}">{{$user->name}} {{$user->phone}}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="main-btn">إضافة</button>
                </form>
            </div>
        </div>
    </div>
</div>
