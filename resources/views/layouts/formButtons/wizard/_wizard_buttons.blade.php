<div class="card-footer">
    <ul class="pager wizard">
        <li class="previous">
            <button type="submit" class="btn btn-primary btn-round pull-left" name="previous" {{ $tagDisabled }}>Previous</button>
        </li>
        @if($finish)
            <li class="finish">
                <button type="submit" class="btn btn-green btn-round pull-right" id="submit-button">Register
                </button>
            </li>
        @else
            <li class="next">
                <button class="btn btn-primary btn-round pull-right" name="next" id="next_btn" type="submit">Next
                </button>
            </li>
        @endif
    </ul>
</div>
