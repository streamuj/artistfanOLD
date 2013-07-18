<?php


/**
 * Base class that represents a query for the 'notification' table.
 *
 * 
 *
 * @method     NotificationQuery orderByNaId($order = Criteria::ASC) Order by the na_id column
 * @method     NotificationQuery orderByNaWallId($order = Criteria::ASC) Order by the na_wall_id column
 * @method     NotificationQuery orderByNaCommentId($order = Criteria::ASC) Order by the na_comment_id column
 * @method     NotificationQuery orderByNaMessage($order = Criteria::ASC) Order by the na_message column
 * @method     NotificationQuery orderByNaUserId($order = Criteria::ASC) Order by the na_user_id column
 * @method     NotificationQuery orderByNaStatus($order = Criteria::ASC) Order by the na_status column
 * @method     NotificationQuery orderByNaDate($order = Criteria::ASC) Order by the na_date column
 *
 * @method     NotificationQuery groupByNaId() Group by the na_id column
 * @method     NotificationQuery groupByNaWallId() Group by the na_wall_id column
 * @method     NotificationQuery groupByNaCommentId() Group by the na_comment_id column
 * @method     NotificationQuery groupByNaMessage() Group by the na_message column
 * @method     NotificationQuery groupByNaUserId() Group by the na_user_id column
 * @method     NotificationQuery groupByNaStatus() Group by the na_status column
 * @method     NotificationQuery groupByNaDate() Group by the na_date column
 *
 * @method     NotificationQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     NotificationQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     NotificationQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     Notification findOne(PropelPDO $con = null) Return the first Notification matching the query
 * @method     Notification findOneOrCreate(PropelPDO $con = null) Return the first Notification matching the query, or a new Notification object populated from the query conditions when no match is found
 *
 * @method     Notification findOneByNaId(int $na_id) Return the first Notification filtered by the na_id column
 * @method     Notification findOneByNaWallId(int $na_wall_id) Return the first Notification filtered by the na_wall_id column
 * @method     Notification findOneByNaCommentId(int $na_comment_id) Return the first Notification filtered by the na_comment_id column
 * @method     Notification findOneByNaMessage(string $na_message) Return the first Notification filtered by the na_message column
 * @method     Notification findOneByNaUserId(int $na_user_id) Return the first Notification filtered by the na_user_id column
 * @method     Notification findOneByNaStatus(int $na_status) Return the first Notification filtered by the na_status column
 * @method     Notification findOneByNaDate(int $na_date) Return the first Notification filtered by the na_date column
 *
 * @method     array findByNaId(int $na_id) Return Notification objects filtered by the na_id column
 * @method     array findByNaWallId(int $na_wall_id) Return Notification objects filtered by the na_wall_id column
 * @method     array findByNaCommentId(int $na_comment_id) Return Notification objects filtered by the na_comment_id column
 * @method     array findByNaMessage(string $na_message) Return Notification objects filtered by the na_message column
 * @method     array findByNaUserId(int $na_user_id) Return Notification objects filtered by the na_user_id column
 * @method     array findByNaStatus(int $na_status) Return Notification objects filtered by the na_status column
 * @method     array findByNaDate(int $na_date) Return Notification objects filtered by the na_date column
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BaseNotificationQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseNotificationQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'artistfan', $modelName = 'Notification', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new NotificationQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    NotificationQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof NotificationQuery) {
			return $criteria;
		}
		$query = new NotificationQuery();
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
	 * @return    Notification|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = NotificationPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(NotificationPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    Notification A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `NA_ID`, `NA_WALL_ID`, `NA_COMMENT_ID`, `NA_MESSAGE`, `NA_USER_ID`, `NA_STATUS`, `NA_DATE` FROM `notification` WHERE `NA_ID` = :p0';
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
			$obj = new Notification();
			$obj->hydrate($row);
			NotificationPeer::addInstanceToPool($obj, (string) $row[0]);
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
	 * @return    Notification|array|mixed the result, formatted by the current formatter
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
	 * @return    NotificationQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(NotificationPeer::NA_ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    NotificationQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(NotificationPeer::NA_ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the na_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByNaId(1234); // WHERE na_id = 1234
	 * $query->filterByNaId(array(12, 34)); // WHERE na_id IN (12, 34)
	 * $query->filterByNaId(array('min' => 12)); // WHERE na_id > 12
	 * </code>
	 *
	 * @param     mixed $naId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    NotificationQuery The current query, for fluid interface
	 */
	public function filterByNaId($naId = null, $comparison = null)
	{
		if (is_array($naId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(NotificationPeer::NA_ID, $naId, $comparison);
	}

	/**
	 * Filter the query on the na_wall_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByNaWallId(1234); // WHERE na_wall_id = 1234
	 * $query->filterByNaWallId(array(12, 34)); // WHERE na_wall_id IN (12, 34)
	 * $query->filterByNaWallId(array('min' => 12)); // WHERE na_wall_id > 12
	 * </code>
	 *
	 * @param     mixed $naWallId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    NotificationQuery The current query, for fluid interface
	 */
	public function filterByNaWallId($naWallId = null, $comparison = null)
	{
		if (is_array($naWallId)) {
			$useMinMax = false;
			if (isset($naWallId['min'])) {
				$this->addUsingAlias(NotificationPeer::NA_WALL_ID, $naWallId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($naWallId['max'])) {
				$this->addUsingAlias(NotificationPeer::NA_WALL_ID, $naWallId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(NotificationPeer::NA_WALL_ID, $naWallId, $comparison);
	}

	/**
	 * Filter the query on the na_comment_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByNaCommentId(1234); // WHERE na_comment_id = 1234
	 * $query->filterByNaCommentId(array(12, 34)); // WHERE na_comment_id IN (12, 34)
	 * $query->filterByNaCommentId(array('min' => 12)); // WHERE na_comment_id > 12
	 * </code>
	 *
	 * @param     mixed $naCommentId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    NotificationQuery The current query, for fluid interface
	 */
	public function filterByNaCommentId($naCommentId = null, $comparison = null)
	{
		if (is_array($naCommentId)) {
			$useMinMax = false;
			if (isset($naCommentId['min'])) {
				$this->addUsingAlias(NotificationPeer::NA_COMMENT_ID, $naCommentId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($naCommentId['max'])) {
				$this->addUsingAlias(NotificationPeer::NA_COMMENT_ID, $naCommentId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(NotificationPeer::NA_COMMENT_ID, $naCommentId, $comparison);
	}

	/**
	 * Filter the query on the na_message column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByNaMessage('fooValue');   // WHERE na_message = 'fooValue'
	 * $query->filterByNaMessage('%fooValue%'); // WHERE na_message LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $naMessage The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    NotificationQuery The current query, for fluid interface
	 */
	public function filterByNaMessage($naMessage = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($naMessage)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $naMessage)) {
				$naMessage = str_replace('*', '%', $naMessage);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(NotificationPeer::NA_MESSAGE, $naMessage, $comparison);
	}

	/**
	 * Filter the query on the na_user_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByNaUserId(1234); // WHERE na_user_id = 1234
	 * $query->filterByNaUserId(array(12, 34)); // WHERE na_user_id IN (12, 34)
	 * $query->filterByNaUserId(array('min' => 12)); // WHERE na_user_id > 12
	 * </code>
	 *
	 * @param     mixed $naUserId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    NotificationQuery The current query, for fluid interface
	 */
	public function filterByNaUserId($naUserId = null, $comparison = null)
	{
		if (is_array($naUserId)) {
			$useMinMax = false;
			if (isset($naUserId['min'])) {
				$this->addUsingAlias(NotificationPeer::NA_USER_ID, $naUserId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($naUserId['max'])) {
				$this->addUsingAlias(NotificationPeer::NA_USER_ID, $naUserId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(NotificationPeer::NA_USER_ID, $naUserId, $comparison);
	}

	/**
	 * Filter the query on the na_status column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByNaStatus(1234); // WHERE na_status = 1234
	 * $query->filterByNaStatus(array(12, 34)); // WHERE na_status IN (12, 34)
	 * $query->filterByNaStatus(array('min' => 12)); // WHERE na_status > 12
	 * </code>
	 *
	 * @param     mixed $naStatus The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    NotificationQuery The current query, for fluid interface
	 */
	public function filterByNaStatus($naStatus = null, $comparison = null)
	{
		if (is_array($naStatus)) {
			$useMinMax = false;
			if (isset($naStatus['min'])) {
				$this->addUsingAlias(NotificationPeer::NA_STATUS, $naStatus['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($naStatus['max'])) {
				$this->addUsingAlias(NotificationPeer::NA_STATUS, $naStatus['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(NotificationPeer::NA_STATUS, $naStatus, $comparison);
	}

	/**
	 * Filter the query on the na_date column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByNaDate(1234); // WHERE na_date = 1234
	 * $query->filterByNaDate(array(12, 34)); // WHERE na_date IN (12, 34)
	 * $query->filterByNaDate(array('min' => 12)); // WHERE na_date > 12
	 * </code>
	 *
	 * @param     mixed $naDate The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    NotificationQuery The current query, for fluid interface
	 */
	public function filterByNaDate($naDate = null, $comparison = null)
	{
		if (is_array($naDate)) {
			$useMinMax = false;
			if (isset($naDate['min'])) {
				$this->addUsingAlias(NotificationPeer::NA_DATE, $naDate['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($naDate['max'])) {
				$this->addUsingAlias(NotificationPeer::NA_DATE, $naDate['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(NotificationPeer::NA_DATE, $naDate, $comparison);
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Notification $notification Object to remove from the list of results
	 *
	 * @return    NotificationQuery The current query, for fluid interface
	 */
	public function prune($notification = null)
	{
		if ($notification) {
			$this->addUsingAlias(NotificationPeer::NA_ID, $notification->getNaId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseNotificationQuery