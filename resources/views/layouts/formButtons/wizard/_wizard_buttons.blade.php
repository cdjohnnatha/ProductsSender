<div class="card-footer">
    <ul class="pager wizard">
        <li class="previous">
            <button class="btn btn-primary btn-round pull-left" name="previous" value="true" type="submit" id="previous_btn" {{ $tagDisabled }}>Previous</button>
        </li>
        @if($finish)
            <li class="">
                <button type="submit" name="register" value="true" class="btn btn-green btn-round pull-right" id="register_btn">Register
                </button>
            </li>
        @else
            <li class="next">
                <button class="btn btn-primary btn-round pull-right" name="next" value="true" id="next_btn" type="submit">Next
                </button>
            </li>
        @endif
    </ul>
</div>
