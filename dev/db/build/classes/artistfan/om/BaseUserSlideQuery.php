<?php


/**
 * Base class that represents a query for the 'user_slide' table.
 *
 * 
 *
 * @method     UserSlideQuery orderByUsId($order = Criteria::ASC) Order by the us_id column
 * @method     UserSlideQuery orderByUsUserId($order = Criteria::ASC) Order by the us_user_id column
 * @method     UserSlideQuery orderByUsSliderPos($order = Criteria::ASC) Order by the us_slider_pos column
 * @method     UserSlideQuery orderByUsSliderImage($order = Criteria::ASC) Order by the us_slider_image column
 * @method     UserSlideQuery orderByUsStatus($order = Criteria::ASC) Order by the us_status column
 *
 * @method     UserSlideQuery groupByUsId() Group by the us_id column
 * @method     UserSlideQuery groupByUsUserId() Group by the us_user_id column
 * @method     UserSlideQuery groupByUsSliderPos() Group by the us_slider_pos column
 * @method     UserSlideQuery groupByUsSliderImage() Group by the us_slider_image column
 * @method     UserSlideQuery groupByUsStatus() Group by the us_status column
 *
 * @method     UserSlideQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     UserSlideQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     UserSlideQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     UserSlide findOne(PropelPDO $con = null) Return the first UserSlide matching the query
 * @method     UserSlide findOneOrCreate(PropelPDO $con = null) Return the first UserSlide matching the query, or a new UserSlide object populated from the query conditions when no match is found
 *
 * @method     UserSlide findOneByUsId(int $us_id) Return the first UserSlide filtered by the us_id column
 * @method     UserSlide findOneByUsUserId(int $us_user_id) Return the first UserSlide filtered by the us_user_id column
 * @method     UserSlide findOneByUsSliderPos(int $us_slider_pos) Return the first UserSlide filtered by the us_slider_pos column
 * @method     UserSlide findOneByUsSliderImage(string $us_slider_image) Return the first UserSlide filtered by the us_slider_image column
 * @method     UserSlide findOneByUsStatus(int $us_status) Return the first UserSlide filtered by the us_status column
 *
 * @method     array findByUsId(int $us_id) Return UserSlide objects filtered by the us_id column
 * @method     array findByUsUserId(int $us_user_id) Return UserSlide objects filtered by the us_user_id column
 * @method     array findByUsSliderPos(int $us_slider_pos) Return UserSlide objects filtered by the us_slider_pos column
 * @method     array findByUsSliderImage(string $us_slider_image) Return UserSlide objects filtered by the us_slider_image column
 * @method     array findByUsStatus(int $us_status) Return UserSlide objects filtered by the us_status column
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BaseUserSlideQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseUserSlideQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'artistfan', $modelName = 'UserSlide', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new UserSlideQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    UserSlideQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof UserSlideQuery) {
			return $criteria;
		}
		$query = new UserSlideQuery();
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
	 * @return    UserSlide|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = UserSlidePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(UserSlidePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    UserSlide A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `US_ID`, `US_USER_ID`, `US_SLIDER_POS`, `US_SLIDER_IMAGE`, `US_STATUS` FROM `user_slide` WHERE `US_ID` = :p0';
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
			$obj = new UserSlide();
			$obj->hydrate($row);
			UserSlidePeer::addInstanceToPool($obj, (string) $row[0]);
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
	 * @return    UserSlide|array|mixed the result, formatted by the current formatter
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
	 * @return    UserSlideQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(UserSlidePeer::US_ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    UserSlideQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(UserSlidePeer::US_ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the us_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByUsId(1234); // WHERE us_id = 1234
	 * $query->filterByUsId(array(12, 34)); // WHERE us_id IN (12, 34)
	 * $query->filterByUsId(array('min' => 12)); // WHERE us_id > 12
	 * </code>
	 *
	 * @param     mixed $usId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserSlideQuery The current query, for fluid interface
	 */
	public function filterByUsId($usId = null, $comparison = null)
	{
		if (is_array($usId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(UserSlidePeer::US_ID, $usId, $comparison);
	}

	/**
	 * Filter the query on the us_user_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByUsUserId(1234); // WHERE us_user_id = 1234
	 * $query->filterByUsUserId(array(12, 34)); // WHERE us_user_id IN (12, 34)
	 * $query->filterByUsUserId(array('min' => 12)); // WHERE us_user_id > 12
	 * </code>
	 *
	 * @param     mixed $usUserId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserSlideQuery The current query, for fluid interface
	 */
	public function filterByUsUserId($usUserId = null, $comparison = null)
	{
		if (is_array($usUserId)) {
			$useMinMax = false;
			if (isset($usUserId['min'])) {
				$this->addUsingAlias(UserSlidePeer::US_USER_ID, $usUserId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($usUserId['max'])) {
				$this->addUsingAlias(UserSlidePeer::US_USER_ID, $usUserId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(UserSlidePeer::US_USER_ID, $usUserId, $comparison);
	}

	/**
	 * Filter the query on the us_slider_pos column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByUsSliderPos(1234); // WHERE us_slider_pos = 1234
	 * $query->filterByUsSliderPos(array(12, 34)); // WHERE us_slider_pos IN (12, 34)
	 * $query->filterByUsSliderPos(array('min' => 12)); // WHERE us_slider_pos > 12
	 * </code>
	 *
	 * @param     mixed $usSliderPos The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserSlideQuery The current query, for fluid interface
	 */
	public function filterByUsSliderPos($usSliderPos = null, $comparison = null)
	{
		if (is_array($usSliderPos)) {
			$useMinMax = false;
			if (isset($usSliderPos['min'])) {
				$this->addUsingAlias(UserSlidePeer::US_SLIDER_POS, $usSliderPos['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($usSliderPos['max'])) {
				$this->addUsingAlias(UserSlidePeer::US_SLIDER_POS, $usSliderPos['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(UserSlidePeer::US_SLIDER_POS, $usSliderPos, $comparison);
	}

	/**
	 * Filter the query on the us_slider_image column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByUsSliderImage('fooValue');   // WHERE us_slider_image = 'fooValue'
	 * $query->filterByUsSliderImage('%fooValue%'); // WHERE us_slider_image LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $usSliderImage The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserSlideQuery The current query, for fluid interface
	 */
	public function filterByUsSliderImage($usSliderImage = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($usSliderImage)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $usSliderImage)) {
				$usSliderImage = str_replace('*', '%', $usSliderImage);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(UserSlidePeer::US_SLIDER_IMAGE, $usSliderImage, $comparison);
	}

	/**
	 * Filter the query on the us_status column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByUsStatus(1234); // WHERE us_status = 1234
	 * $query->filterByUsStatus(array(12, 34)); // WHERE us_status IN (12, 34)
	 * $query->filterByUsStatus(array('min' => 12)); // WHERE us_status > 12
	 * </code>
	 *
	 * @param     mixed $usStatus The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserSlideQuery The current query, for fluid interface
	 */
	public function filterByUsStatus($usStatus = null, $comparison = null)
	{
		if (is_array($usStatus)) {
			$useMinMax = false;
			if (isset($usStatus['min'])) {
				$this->addUsingAlias(UserSlidePeer::US_STATUS, $usStatus['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($usStatus['max'])) {
				$this->addUsingAlias(UserSlidePeer::US_STATUS, $usStatus['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(UserSlidePeer::US_STATUS, $usStatus, $comparison);
	}

	/**
	 * Exclude object from result
	 *
	 * @param     UserSlide $userSlide Object to remove from the list of results
	 *
	 * @return    UserSlideQuery The current query, for fluid interface
	 */
	public function prune($userSlide = null)
	{
		if ($userSlide) {
			$this->addUsingAlias(UserSlidePeer::US_ID, $userSlide->getUsId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseUserSlideQuery