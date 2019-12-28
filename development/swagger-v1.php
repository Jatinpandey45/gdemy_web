<?php
/**
 * @SWG\Swagger(
 *     schemes={"http"},
 *     host=API_HOST,
 *     basePath="/",
 *     @SWG\Info(
 *         version="1.0.0",
 *         title="GKDemy",
 *         description="Getting started with gkdemy swagger doc",
 *         termsOfService="",
 *         @SWG\Contact(
 *             email="support@gkdemy.com"
 *         ),
 *     ),
 * )
 */


 /**
 * @SWG\Get(
 *     path="/home",
 *     tags = {"HOME"},
 *     summary="Return top most five records",
 *     @SWG\Response(
 *         response=200,
 *         description="OK",
 *     ),
 *     @SWG\Response(
 *         response=422,
 *         description="Missing Data"
 *     )
 * )
 */


  /**
 * @SWG\Get(
 *     path="/category/{category_id}",
 *     tags = {"CATEGORY RELATED POSTS"},
 *     summary="Returns category specific post",
 *     @SWG\Parameter(
 *         name="page",
 *         in="query",
 *         type="string",
 *         description="page number",
 *         required=true,
 *     ),
 *     @SWG\Parameter(
 *         name="category_id",
 *         in="path",
 *         type="string",
 *         description="category id you get from list",
 *         required=true,
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="OK",
 *     ),
 *     @SWG\Response(
 *         response=422,
 *         description="Missing Data"
 *     )
 * )
 */


/**
 * @SWG\Get(
 *     path="/month",
 *     tags = {"MONTH"},
 *     summary="Returns current year months starting from Nov 2019",
 *     @SWG\Parameter(
 *         name="page",
 *         in="query",
 *         type="string",
 *         description="page number",
 *         required=true,
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="OK",
 *     ),
 *     @SWG\Response(
 *         response=422,
 *         description="Missing Data"
 *     )
 * )
 */


/**
 * @SWG\Get(
 *     path="/month/{month_id}",
 *     tags = {"MONTH"},
 *     summary="Returns month specific posts",
 *     @SWG\Parameter(
 *         name="page",
 *         in="query",
 *         type="string",
 *         description="page number",
 *         required=true,
 *     ),
 *     @SWG\Parameter(
 *         name="month_id",
 *         in="path",
 *         type="string",
 *         description="month id you get from list",
 *         required=true,
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="OK",
 *     ),
 *     @SWG\Response(
 *         response=422,
 *         description="Missing Data"
 *     )
 * )
 */



/**
 * @SWG\Get(
 *     path="/post",
 *     tags = {"POST"},
 *     summary="Returns top most 10 posts",
 *     @SWG\Parameter(
 *         name="page",
 *         in="query",
 *         type="string",
 *         description="page number",
 *         required=true,
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="OK",
 *     ),
 *     @SWG\Response(
 *         response=422,
 *         description="Missing Data"
 *     )
 * )
 */



/**
 * @SWG\Get(
 *     path="/post/{post_id}",
 *     tags = {"POST"},
 *     summary="Returns post detail data",
 *     @SWG\Parameter(
 *         name="post_id",
 *         in="path",
 *         type="string",
 *         description="post id you get from list",
 *         required=true,
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="OK",
 *     ),
 *     @SWG\Response(
 *         response=422,
 *         description="Missing Data"
 *     )
 * )
 */


 /**
 * @SWG\Get(
 *     path="/tag/{tag_id}",
 *     tags = {"TAG RELATED POST"},
 *     summary="Returns tag related posts",
 *     @SWG\Parameter(
 *         name="tag_id",
 *         in="path",
 *         type="string",
 *         description="tag id you get from list",
 *         required=true,
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="OK",
 *     ),
 *     @SWG\Response(
 *         response=422,
 *         description="Missing Data"
 *     )
 * )
 */



 /**
 * @SWG\Get(
 *     path="/jobs",
 *     tags = {"JOBS"},
 *     summary="Returns top most 10 jobs",
 *     @SWG\Parameter(
 *         name="page",
 *         in="query",
 *         type="string",
 *         description="page number",
 *         required=true,
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="OK",
 *     ),
 *     @SWG\Response(
 *         response=422,
 *         description="Missing Data"
 *     )
 * )
 */


 /**
 * @SWG\Get(
 *     path="/jobs/{job_id}",
 *     tags = {"JOBS"},
 *     summary="Returns job detail data",
 *     @SWG\Parameter(
 *         name="job_id",
 *         in="path",
 *         type="string",
 *         description="job id you get from list",
 *         required=true,
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="OK",
 *     ),
 *     @SWG\Response(
 *         response=422,
 *         description="Missing Data"
 *     )
 * )
 */