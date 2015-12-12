<?php

class Votee
{
	public static function view( $obj, $obj_id, $vote_up, $vote_down )
	{
		$btn1 = 'default';
		$disabled1 = '';
		$btn2 = 'default';
		$disabled2 = '';

		if ( Auth::check() )
		{
			$user_id = Auth::user()->id;

			$vote = Vote::where('user_id', $user_id)
						->where('obj_id', $obj_id)
						->where('obj', $obj)
						->first();
			if ( $vote )
			{
				if ( $vote->vote == 1 )
				{
					$btn1 = 'success';
					$disabled2 = 'disabled="disabled"';
				} elseif( $vote->vote == -1 )
				{
					$btn2 = 'danger';
					$disabled1 = 'disabled="disabled"';
				}
			}
		} ?>

		<div class="btn-group btn-group-lg" id="vote-btn">
			<button
				class="btn btn-<?= $btn1 ?>"
				id="voteUp" <?= $disabled1 ?> >
				<i class="fa fa-thumbs-o-up fa-lg"></i>
				<small>
					<span class="vote-num" id="vote-up-num">
						<?= $vote_up != 0 ? $vote_up : '' ?>
					</span>
				</small>
			</button>
			<button
				class="btn btn-<?= $btn2 ?>"
				id="voteDown" <?= $disabled2 ?> >
				<i class="fa fa-thumbs-o-down fa-lg"></i>
				<small>
					<span class="vote-num" id="vote-down-num">
						<?= $vote_down != 0 ? $vote_down : '' ?>
					</span>
				</small>
			</button>
		</div>

	<?php }
}