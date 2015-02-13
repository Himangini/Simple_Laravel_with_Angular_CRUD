<?php
class CommentController extends \BaseController {
	/**
	 * Send back all comments as JSON
	 *
	 * @return Response
	 */
	public function index()
	{
		return Response::json(Comment::get());
	}
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if(!Input::get('id'))
		{
			Comment::create(array(
				'author' => Input::get('author'),
				'text' => Input::get('text')
			));
		}
		else
		{
			$comment = Comment::find(Input::get('id'));
 
			if($comment){
            $comment->author    = Input::get('author');
            $comment->text    = Input::get('text');
			$comment->save();
			return Redirect::to('/');
			}
		}
		return Response::json(array('success' => true));
	}
	
	/**
	 * Return the specified resource using JSON
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return Response::json(Comment::find($id));
	}
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Comment::destroy($id);
		return Response::json(array('success' => true));
	}
}