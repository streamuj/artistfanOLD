<?php


/**
 * Base class that represents a query for the 'video' table.
 *
 * 
 *
 * @method     VideoQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     VideoQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     VideoQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     VideoQuery orderByPrice($order = Criteria::ASC) Order by the price column
 * @method     VideoQuery orderByVideo($order = Criteria::ASC) Order by the video column
 * @method     VideoQuery orderByVideoPreview($order = Criteria::ASC) Order by the video_preview column
 * @method     VideoQuery orderByPdate($order = Criteria::ASC) Order by the pdate column
 * @method     VideoQuery orderByActive($order = Criteria::ASC) Order by the active column
 * @method     VideoQuery orderByDeleted($order = Criteria::ASC) Order by the deleted column
 * @method     VideoQuery orderByFromYt($order = Criteria::ASC) Order by the from_yt column
 * @method     VideoQuery orderByStatus($order = Criteria::ASC) Order by the status column
 *
 * @method     VideoQuery groupById() Group by the id column
 * @method     VideoQuery groupByUserId() Group by the user_id column
 * @method     VideoQuery groupByTitle() Group by the title column
 * @method     VideoQuery groupByPrice() Group by the price column
 * @method     VideoQuery groupByVideo() Group by the video column
 * @method     VideoQuery groupByVideoPreview() Group by the video_preview column
 * @method     VideoQuery groupByPdate() Group by the pdate column
 * @method     VideoQuery groupByActive() Group by the active column
 * @method     VideoQuery groupByDeleted() Group by the deleted column
 * @method     VideoQuery groupByFromYt() Group by the from_yt column
 * @method     VideoQuery groupByStatus() Group by the status column
 *
 * @method     VideoQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     VideoQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     VideoQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     VideoQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     VideoQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     VideoQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     VideoQuery leftJoinVideoPurchase($relationAlias = null) Adds a LEFT JOIN clause to the query using the VideoPurchase relation
 * @method     VideoQuery rightJoinVideoPurchase($relationAlias = null) Adds a RIGHT JOIN clause to the query using the VideoPurchase relation
 * @method     VideoQuery innerJoinVideoPurchase($relationAlias = null) Adds a INNER JOIN clause to the query using the VideoPurchase relation
 *
 * @method     Video findOne(PropelPDO $con = null) Return the first Video matching the query
 * @method     Video findOneOrCreate(PropelPDO $con = null) Return the first Video matching the query, or a new Video object populated from the query conditions when no match is found
 *
 * @method     Video findOneById(int $id) Return the first Video filtered by the id column
 * @method     Video findOneByUserId(int $user_id) Return the first Video filtered by the user_id column
 * @method     Video findOneByTitle(string $title) Return the first Video filtered by the title column
 * @method     Video findOneByPrice(double $price) Return the first Video filtered by the price column
 * @method     Video findOneByVideo(string $video) Return the first Video filtered by the video column
 * @method     Video findOneByVideoPreview(string $video_preview) Return the first Video filtered by the video_preview column
 * @method     Video findOneByPdate(int $pdate) Return the first Video filtered by the pdate column
 * @method     Video findOneByActive(int $active) Return the first Video filtered by the active column
 * @method     Video findOneByDeleted(int $deleted) Return the first Video filtered by the deleted column
 * @method     Video findOneByFromYt(int $from_yt) Return the first Video filtered by the from_yt column
 * @method     Video findOneByStatus(int $status) Return the first Video filtered by the status column
 *
 * @method     array findById(int $id) Return Video objects filtered by the id column
 * @method     array findByUserId(int $user_id) Return Video objects filtered by the user_id column
 * @method     array findByTitle(string $title) Return Video objects filtered by the title column
 * @method     array findByPrice(double $price) Return Video objects filtered by the price column
 * @method     array findByVideo(string $video) Return Video objects filtered by the video column
 * @method     array findByVideoPreview(string $video_preview) Return Video objects filtered by the video_preview column
 * @method     array findByPdate(int $pdate) Return Video objects filtered by the pdate column
 * @method     array findByActive(int $active) Return Video objects filtered by the active column
 * @method     array findByDeleted(int $deleted) Return Video objects filtered by the deleted column
 * @method     array findByFromYt(int $from_yt) Return Video objects filtered by the from_yt column
 * @method     array findByStatus(int $status) Return Video objects filtered by the status column
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BaseVideoQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseVideoQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'artistfan', $modelName = 'Video', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new VideoQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    VideoQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof VideoQuery) {
			return $criteria;
		}
		$query = new VideoQuery();
		if (null !== $modelAlias) {
			$query->setModelAlias($modelAlias);
		}
		if ($criteria instanceof Criteria) {
			$query->mergeWith($criteria);
		}
		return $query;
	}

	/**
	 * Find object by primary key.
	 * Propel uses the instance pool to skip the database if the object exists.
	 * Go fast if the query is untouched.
	 *
	 * <code>
	 * $obj  = $c->findPk(12, $con);
	 * </code>
	 *
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    Video|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = VideoPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(VideoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$this->basePreSelect($con);
		if ($this->formatter || $this->modelAlias || $this->with || $this->select
		 || $this->selectColumns || $this->asColumns || $this->selectModifiers
		 || $this->map || $this->having || $this->joins) {
			return $this->findPkComplex($key, $con);
		} else {
			return $this->findPkSimple($key, $con);
		}
	}

	/**
	 * Find object by primary key using raw SQL to go fast.
	 * Bypass doSelect() and the object formatter by using generated code.
	 *
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con A connection object
	 *
	 * @return    Video A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ID`, `USER_ID`, `TITLE`, `PRICE`, `VIDEO`, `VIDEO_PREVIEW`, `PDATE`, `ACTIVE`, `DELETED`, `FROM_YT`, `STATUS` , `FEATURED`, `PAY_MORE`, `VIDEO_LENGTH` , `VIDEO_COUNT`, `VIDEO_TYPE`, `VIDEO_DATE`, `VIDEO_IMAGE`   FROM `video` WHERE `ID` = :p0';
		try {
			$stmt = $con->prepare($sql);
			$stmt->bindValue(':p0', $key, PDO::PARAM_INT);
			$stmt->execute();
		} catch (Exception $e) {
			Propel::log($e->getMessage(), Propel::LOG_ERR);
			throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
		}
		$obj = null;
		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$obj = new Video();
			$obj->hydrate($row);
			VideoPeer::addInstanceToPool($obj, (string) $key);
		}
		$stmt->closeCursor();

		return $obj;
	}

	/**
	 * Find object by primary key.
	 *
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con A connection object
	 *
	 * @return    Video|array|mixed the result, formatted by the current formatter
	 */
	protected function findPkComplex($key, $con)
	{
		// As the query uses a PK condition, no limit(1) is necessary.
		$criteria = $this->isKeepQuery() ? clone $this : $this;
		$stmt = $criteria
			->filterByPrimaryKey($key)
			->doSelect($con);
		return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
	}

	/**
	 * Find objects by primary key
	 * <code>
	 * $objs = $c->findPks(array(12, 56, 832), $con);
	 * </code>
	 * @param     array $keys Primary keys to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    PropelObjectCollection|array|mixed the list of results, formatted by the current formatter
	 */
	public function findPks($keys, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
		}
		$this->basePreSelect($con);
		$criteria = $this->isKeepQuery() ? clone $this : $this;
		$stmt = $criteria
			->filterByPrimaryKeys($keys)
			->doSelect($con);
		return $criteria->getFormatter()->init($criteria)->format($stmt);
	}

	/**
	 * Filter the query by primary key
	 *
	 * @param     mixed $key Primary key to use for the query
	 *
	 * @return    VideoQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(VideoPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    VideoQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(VideoPeer::ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterById(1234); // WHERE id = 1234
	 * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
	 * $query->filterById(array('min' => 12)); // WHERE id > 12
	 * </code>
	 *
	 * @param     mixed $id The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    VideoQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(VideoPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the user_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByUserId(1234); // WHERE user_id = 1234
	 * $query->filterByUserId(array(12, 34)); // WHERE user_id IN (12, 34)
	 * $query->filterByUserId(array('min' => 12)); // WHERE user_id > 12
	 * </code>
	 *
	 * @see       filterByUser()
	 *
	 * @param     mixed $userId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    VideoQuery The current query, for fluid interface
	 */
	public function filterByUserId($userId = null, $comparison = null)
	{
		if (is_array($userId)) {
			$useMinMax = false;
			if (isset($userId['min'])) {
				$this->addUsingAlias(VideoPeer::USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($userId['max'])) {
				$this->addUsingAlias(VideoPeer::USER_ID, $userId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(VideoPeer::USER_ID, $userId, $comparison);
	}

	/**
	 * Filter the query on the title column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByTitle('fooValue');   // WHERE title = 'fooValue'
	 * $query->filterByTitle('%fooValue%'); // WHERE title LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $title The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    VideoQuery The current query, for fluid interface
	 */
	public function filterByTitle($title = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($title)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $title)) {
				$title = str_replace('*', '%', $title);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(VideoPeer::TITLE, $title, $comparison);
	}

	/**
	 * Filter the query on the price column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByPrice(1234); // WHERE price = 1234
	 * $query->filterByPrice(array(12, 34)); // WHERE price IN (12, 34)
	 * $query->filterByPrice(array('min' => 12)); // WHERE price > 12
	 * </code>
	 *
	 * @param     mixed $price The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    VideoQuery The current query, for fluid interface
	 */
	public function filterByPrice($price = null, $comparison = null)
	{
		if (is_array($price)) {
			$useMinMax = false;
			if (isset($price['min'])) {
				$this->addUsingAlias(VideoPeer::PRICE, $price['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($price['max'])) {
				$this->addUsingAlias(VideoPeer::PRICE, $price['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(VideoPeer::PRICE, $price, $comparison);
	}

	/**
	 * Filter the query on the video column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByVideo('fooValue');   // WHERE video = 'fooValue'
	 * $query->filterByVideo('%fooValue%'); // WHERE video LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $video The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    VideoQuery The current query, for fluid interface
	 */
	public function filterByVideo($video = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($video)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $video)) {
				$video = str_replace('*', '%', $video);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(VideoPeer::VIDEO, $video, $comparison);
	}

	/**
	 * Filter the query on the video_preview column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByVideoPreview('fooValue');   // WHERE video_preview = 'fooValue'
	 * $query->filterByVideoPreview('%fooValue%'); // WHERE video_preview LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $videoPreview The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    VideoQuery The current query, for fluid interface
	 */
	public function filterByVideoPreview($videoPreview = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($videoPreview)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $videoPreview)) {
				$videoPreview = str_replace('*', '%', $videoPreview);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(VideoPeer::VIDEO_PREVIEW, $videoPreview, $comparison);
	}

	/**
	 * Filter the query on the pdate column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByPdate(1234); // WHERE pdate = 1234
	 * $query->filterByPdate(array(12, 34)); // WHERE pdate IN (12, 34)
	 * $query->filterByPdate(array('min' => 12)); // WHERE pdate > 12
	 * </code>
	 *
	 * @param     mixed $pdate The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    VideoQuery The current query, for fluid interface
	 */
	public function filterByPdate($pdate = null, $comparison = null)
	{
		if (is_array($pdate)) {
			$useMinMax = false;
			if (isset($pdate['min'])) {
				$this->addUsingAlias(VideoPeer::PDATE, $pdate['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($pdate['max'])) {
				$this->addUsingAlias(VideoPeer::PDATE, $pdate['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(VideoPeer::PDATE, $pdate, $comparison);
	}

	/**
	 * Filter the query on the active column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByActive(1234); // WHERE active = 1234
	 * $query->filterByActive(array(12, 34)); // WHERE active IN (12, 34)
	 * $query->filterByActive(array('min' => 12)); // WHERE active > 12
	 * </code>
	 *
	 * @param     mixed $active The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    VideoQuery The current query, for fluid interface
	 */
	public function filterByActive($active = null, $comparison = null)
	{
		if (is_array($active)) {
			$useMinMax = false;
			if (isset($active['min'])) {
				$this->addUsingAlias(VideoPeer::ACTIVE, $active['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($active['max'])) {
				$this->addUsingAlias(VideoPeer::ACTIVE, $active['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(VideoPeer::ACTIVE, $active, $comparison);
	}

	/**
	 * Filter the query on the deleted column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByDeleted(1234); // WHERE deleted = 1234
	 * $query->filterByDeleted(array(12, 34)); // WHERE deleted IN (12, 34)
	 * $query->filterByDeleted(array('min' => 12)); // WHERE deleted > 12
	 * </code>
	 *
	 * @param     mixed $deleted The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    VideoQuery The current query, for fluid interface
	 */
	public function filterByDeleted($deleted = null, $comparison = null)
	{
		if (is_array($deleted)) {
			$useMinMax = false;
			if (isset($deleted['min'])) {
				$this->addUsingAlias(VideoPeer::DELETED, $deleted['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($deleted['max'])) {
				$this->addUsingAlias(VideoPeer::DELETED, $deleted['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(VideoPeer::DELETED, $deleted, $comparison);
	}

	/**
	 * Filter the query on the from_yt column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByFromYt(1234); // WHERE from_yt = 1234
	 * $query->filterByFromYt(array(12, 34)); // WHERE from_yt IN (12, 34)
	 * $query->filterByFromYt(array('min' => 12)); // WHERE from_yt > 12
	 * </code>
	 *
	 * @param     mixed $fromYt The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    VideoQuery The current query, for fluid interface
	 */
	public function filterByFromYt($fromYt = null, $comparison = null)
	{
		if (is_array($fromYt)) {
			$useMinMax = false;
			if (isset($fromYt['min'])) {
				$this->addUsingAlias(VideoPeer::FROM_YT, $fromYt['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($fromYt['max'])) {
				$this->addUsingAlias(VideoPeer::FROM_YT, $fromYt['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(VideoPeer::FROM_YT, $fromYt, $comparison);
	}

	/**
	 * Filter the query on the status column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByStatus(1234); // WHERE status = 1234
	 * $query->filterByStatus(array(12, 34)); // WHERE status IN (12, 34)
	 * $query->filterByStatus(array('min' => 12)); // WHERE status > 12
	 * </code>
	 *
	 * @param     mixed $status The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    VideoQuery The current query, for fluid interface
	 */
	public function filterByStatus($status = null, $comparison = null)
	{
		if (is_array($status)) {
			$useMinMax = false;
			if (isset($status['min'])) {
				$this->addUsingAlias(VideoPeer::STATUS, $status['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($status['max'])) {
				$this->addUsingAlias(VideoPeer::STATUS, $status['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(VideoPeer::STATUS, $status, $comparison);
	}


	/**
	 * Filter the query on the featured column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByFeatured(1234); // WHERE featured = 1234
	 * $query->filterByFeatured(array(12, 34)); // WHERE featured IN (12, 34)
	 * $query->filterByFeatured(array('min' => 12)); // WHERE featured > 12
	 * </code>
	 *
	 * @param     mixed $featured The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    VideoQuery The current query, for fluid interface
	 */
	public function filterByFeatured($featured = null, $comparison = null)
	{
		if (is_array($featured)) {
			$useMinMax = false;
			if (isset($featured['min'])) {
				$this->addUsingAlias(VideoPeer::FEATURED, $featured['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($featured['max'])) {
				$this->addUsingAlias(VideoPeer::FEATURED, $featured['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(VideoPeer::FEATURED, $featured, $comparison);
	}
	
	/**
	 * Filter the query on the pay_more column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByPayMore(1234); // WHERE pay_more = 1234
	 * $query->filterByPayMore(array(12, 34)); // WHERE pay_more IN (12, 34)
	 * $query->filterByPayMore(array('min' => 12)); // WHERE pay_more > 12
	 * </code>
	 *
	 * @param     mixed $payMore The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    VideoQuery The current query, for fluid interface
	 */
	public function filterByPayMore($payMore = null, $comparison = null)
	{
		if (is_array($payMore)) {
			$useMinMax = false;
			if (isset($payMore['min'])) {
				$this->addUsingAlias(VideoPeer::PAY_MORE, $payMore['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($payMore['max'])) {
				$this->addUsingAlias(VideoPeer::PAY_MORE, $payMore['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(VideoPeer::PAY_MORE, $payMore, $comparison);
	}

	/**
	 * Filter the query on the video_length column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByVideoLength('fooValue');   // WHERE video_length = 'fooValue'
	 * $query->filterByVideoLength('%fooValue%'); // WHERE video_length LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $videoLength The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    VideoQuery The current query, for fluid interface
	 */
	public function filterByVideoLength($videoLength = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($videoLength)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $videoLength)) {
				$videoLength = str_replace('*', '%', $videoLength);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(VideoPeer::VIDEO_LENGTH, $videoLength, $comparison);
	}
	
	/**
	 * Filter the query on the video_count column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByVideoCount(1234); // WHERE video_count = 1234
	 * $query->filterByVideoCount(array(12, 34)); // WHERE video_count IN (12, 34)
	 * $query->filterByVideoCount(array('min' => 12)); // WHERE video_count > 12
	 * </code>
	 *
	 * @param     mixed $videoCount The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    VideoQuery The current query, for fluid interface
	 */
	public function filterByVideoCount($videoCount = null, $comparison = null)
	{
		if (is_array($videoCount)) {
			$useMinMax = false;
			if (isset($videoCount['min'])) {
				$this->addUsingAlias(VideoPeer::VIDEO_COUNT, $videoCount['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($videoCount['max'])) {
				$this->addUsingAlias(VideoPeer::VIDEO_COUNT, $videoCount['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(VideoPeer::VIDEO_COUNT, $videoCount, $comparison);
	}
	
	/**
	 * Filter the query on the video_type column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByVideoType(1234); // WHERE video_type = 1234
	 * $query->filterByVideoType(array(12, 34)); // WHERE video_type IN (12, 34)
	 * $query->filterByVideoType(array('min' => 12)); // WHERE video_type > 12
	 * </code>
	 *
	 * @param     mixed $videoType The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    VideoQuery The current query, for fluid interface
	 */
	public function filterByVideoType($videoType = null, $comparison = null)
	{
		if (is_array($videoType)) {
			$useMinMax = false;
			if (isset($videoType['min'])) {
				$this->addUsingAlias(VideoPeer::VIDEO_TYPE, $videoType['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($videoType['max'])) {
				$this->addUsingAlias(VideoPeer::VIDEO_TYPE, $videoType['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(VideoPeer::VIDEO_TYPE, $videoType, $comparison);
	}

	/**
	 * Filter the query on the video_date column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByVideoDate(1234); // WHERE video_date = 1234
	 * $query->filterByVideoDate(array(12, 34)); // WHERE video_date IN (12, 34)
	 * $query->filterByVideoDate(array('min' => 12)); // WHERE video_date > 12
	 * </code>
	 *
	 * @param     mixed $videoDate The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    VideoQuery The current query, for fluid interface
	 */
	public function filterByVideoDate($videoDate = null, $comparison = null)
	{
		if (is_array($videoDate)) {
			$useMinMax = false;
			if (isset($videoDate['min'])) {
				$this->addUsingAlias(VideoPeer::VIDEO_DATE, $videoDate['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($videoDate['max'])) {
				$this->addUsingAlias(VideoPeer::VIDEO_DATE, $videoDate['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(VideoPeer::VIDEO_DATE, $videoDate, $comparison);
	}

	/**
	 * Filter the query on the video_image column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByVideoImage('fooValue');   // WHERE video_image = 'fooValue'
	 * $query->filterByVideoImage('%fooValue%'); // WHERE video_image LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $videoImage The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    VideoQuery The current query, for fluid interface
	 */
	public function filterByVideoImage($videoImage = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($videoImage)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $videoImage)) {
				$videoImage = str_replace('*', '%', $videoImage);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(VideoPeer::VIDEO_IMAGE, $videoImage, $comparison);
	}


	/**
	 * Filter the query by a related User object
	 *
	 * @param     User|PropelCollection $user The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    VideoQuery The current query, for fluid interface
	 */
	public function filterByUser($user, $comparison = null)
	{
		if ($user instanceof User) {
			return $this
				->addUsingAlias(VideoPeer::USER_ID, $user->getId(), $comparison);
		} elseif ($user instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(VideoPeer::USER_ID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByUser() only accepts arguments of type User or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the User relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    VideoQuery The current query, for fluid interface
	 */
	public function joinUser($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('User');

		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}

		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'User');
		}

		return $this;
	}

	/**
	 * Use the User relation User object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    UserQuery A secondary query class using the current class as primary query
	 */
	public function useUserQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinUser($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'User', 'UserQuery');
	}

	/**
	 * Filter the query by a related VideoPurchase object
	 *
	 * @param     VideoPurchase $videoPurchase  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    VideoQuery The current query, for fluid interface
	 */
	public function filterByVideoPurchase($videoPurchase, $comparison = null)
	{
		if ($videoPurchase instanceof VideoPurchase) {
			return $this
				->addUsingAlias(VideoPeer::ID, $videoPurchase->getVideoId(), $comparison);
		} elseif ($videoPurchase instanceof PropelCollection) {
			return $this
				->useVideoPurchaseQuery()
				->filterByPrimaryKeys($videoPurchase->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByVideoPurchase() only accepts arguments of type VideoPurchase or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the VideoPurchase relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    VideoQuery The current query, for fluid interface
	 */
	public function joinVideoPurchase($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('VideoPurchase');

		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}

		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'VideoPurchase');
		}

		return $this;
	}

	/**
	 * Use the VideoPurchase relation VideoPurchase object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    VideoPurchaseQuery A secondary query class using the current class as primary query
	 */
	public function useVideoPurchaseQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinVideoPurchase($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'VideoPurchase', 'VideoPurchaseQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Video $video Object to remove from the list of results
	 *
	 * @return    VideoQuery The current query, for fluid interface
	 */
	public function prune($video = null)
	{
		if ($video) {
			$this->addUsingAlias(VideoPeer::ID, $video->getId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseVideoQuery