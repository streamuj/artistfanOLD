<?php


/**
 * Base class that represents a query for the 'event' table.
 *
 * 
 *
 * @method     EventQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     EventQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     EventQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     EventQuery orderByDescr($order = Criteria::ASC) Order by the descr column
 * @method     EventQuery orderByEventType($order = Criteria::ASC) Order by the event_type column
 * @method     EventQuery orderByLocation($order = Criteria::ASC) Order by the location column
 * @method     EventQuery orderByPrice($order = Criteria::ASC) Order by the price column
 * @method     EventQuery orderByEventDate($order = Criteria::ASC) Order by the event_date column
 * @method     EventQuery orderByCode($order = Criteria::ASC) Order by the code column
 * @method     EventQuery orderByPdate($order = Criteria::ASC) Order by the pdate column
 * @method     EventQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     EventQuery orderByDeleted($order = Criteria::ASC) Order by the deleted column
 *
 * @method     EventQuery groupById() Group by the id column
 * @method     EventQuery groupByUserId() Group by the user_id column
 * @method     EventQuery groupByTitle() Group by the title column
 * @method     EventQuery groupByDescr() Group by the descr column
 * @method     EventQuery groupByEventType() Group by the event_type column
 * @method     EventQuery groupByLocation() Group by the location column
 * @method     EventQuery groupByPrice() Group by the price column
 * @method     EventQuery groupByEventDate() Group by the event_date column
 * @method     EventQuery groupByCode() Group by the code column
 * @method     EventQuery groupByPdate() Group by the pdate column
 * @method     EventQuery groupByStatus() Group by the status column
 * @method     EventQuery groupByDeleted() Group by the deleted column
 *
 * @method     EventQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     EventQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     EventQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     EventQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     EventQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     EventQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     EventQuery leftJoinEventAttend($relationAlias = null) Adds a LEFT JOIN clause to the query using the EventAttend relation
 * @method     EventQuery rightJoinEventAttend($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EventAttend relation
 * @method     EventQuery innerJoinEventAttend($relationAlias = null) Adds a INNER JOIN clause to the query using the EventAttend relation
 *
 * @method     EventQuery leftJoinEventPurchase($relationAlias = null) Adds a LEFT JOIN clause to the query using the EventPurchase relation
 * @method     EventQuery rightJoinEventPurchase($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EventPurchase relation
 * @method     EventQuery innerJoinEventPurchase($relationAlias = null) Adds a INNER JOIN clause to the query using the EventPurchase relation
 *
 * @method     EventQuery leftJoinEventVideo($relationAlias = null) Adds a LEFT JOIN clause to the query using the EventVideo relation
 * @method     EventQuery rightJoinEventVideo($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EventVideo relation
 * @method     EventQuery innerJoinEventVideo($relationAlias = null) Adds a INNER JOIN clause to the query using the EventVideo relation
 *
 * @method     Event findOne(PropelPDO $con = null) Return the first Event matching the query
 * @method     Event findOneOrCreate(PropelPDO $con = null) Return the first Event matching the query, or a new Event object populated from the query conditions when no match is found
 *
 * @method     Event findOneById(int $id) Return the first Event filtered by the id column
 * @method     Event findOneByUserId(int $user_id) Return the first Event filtered by the user_id column
 * @method     Event findOneByTitle(string $title) Return the first Event filtered by the title column
 * @method     Event findOneByDescr(string $descr) Return the first Event filtered by the descr column
 * @method     Event findOneByEventType(int $event_type) Return the first Event filtered by the event_type column
 * @method     Event findOneByLocation(string $location) Return the first Event filtered by the location column
 * @method     Event findOneByPrice(double $price) Return the first Event filtered by the price column
 * @method     Event findOneByEventDate(string $event_date) Return the first Event filtered by the event_date column
 * @method     Event findOneByCode(string $code) Return the first Event filtered by the code column
 * @method     Event findOneByPdate(int $pdate) Return the first Event filtered by the pdate column
 * @method     Event findOneByStatus(int $status) Return the first Event filtered by the status column
 * @method     Event findOneByDeleted(int $deleted) Return the first Event filtered by the deleted column
 *
 * @method     array findById(int $id) Return Event objects filtered by the id column
 * @method     array findByUserId(int $user_id) Return Event objects filtered by the user_id column
 * @method     array findByTitle(string $title) Return Event objects filtered by the title column
 * @method     array findByDescr(string $descr) Return Event objects filtered by the descr column
 * @method     array findByEventType(int $event_type) Return Event objects filtered by the event_type column
 * @method     array findByLocation(string $location) Return Event objects filtered by the location column
 * @method     array findByPrice(double $price) Return Event objects filtered by the price column
 * @method     array findByEventDate(string $event_date) Return Event objects filtered by the event_date column
 * @method     array findByCode(string $code) Return Event objects filtered by the code column
 * @method     array findByPdate(int $pdate) Return Event objects filtered by the pdate column
 * @method     array findByStatus(int $status) Return Event objects filtered by the status column
 * @method     array findByDeleted(int $deleted) Return Event objects filtered by the deleted column
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BaseEventQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseEventQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'artistfan', $modelName = 'Event', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new EventQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    EventQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof EventQuery) {
			return $criteria;
		}
		$query = new EventQuery();
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
	 * @return    Event|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = EventPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(EventPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    Event A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ID`, `USER_ID`, `TITLE`, `DESCR`, `EVENT_TYPE`, `LOCATION`, `PRICE`, `EVENT_DATE`, `CODE`, `PDATE`, `STATUS`, `DELETED`, `EVENT_PHOTO`, `EVENT_APP`, `DURATION`  FROM `event` WHERE `ID` = :p0';
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
			$obj = new Event();
			$obj->hydrate($row);
			EventPeer::addInstanceToPool($obj, (string) $key);
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
	 * @return    Event|array|mixed the result, formatted by the current formatter
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
	 * @return    EventQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(EventPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    EventQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(EventPeer::ID, $keys, Criteria::IN);
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
	 * @return    EventQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(EventPeer::ID, $id, $comparison);
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
	 * @return    EventQuery The current query, for fluid interface
	 */
	public function filterByUserId($userId = null, $comparison = null)
	{
		if (is_array($userId)) {
			$useMinMax = false;
			if (isset($userId['min'])) {
				$this->addUsingAlias(EventPeer::USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($userId['max'])) {
				$this->addUsingAlias(EventPeer::USER_ID, $userId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(EventPeer::USER_ID, $userId, $comparison);
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
	 * @return    EventQuery The current query, for fluid interface
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
		return $this->addUsingAlias(EventPeer::TITLE, $title, $comparison);
	}

	/**
	 * Filter the query on the descr column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByDescr('fooValue');   // WHERE descr = 'fooValue'
	 * $query->filterByDescr('%fooValue%'); // WHERE descr LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $descr The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    EventQuery The current query, for fluid interface
	 */
	public function filterByDescr($descr = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($descr)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $descr)) {
				$descr = str_replace('*', '%', $descr);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(EventPeer::DESCR, $descr, $comparison);
	}

	/**
	 * Filter the query on the event_type column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByEventType(1234); // WHERE event_type = 1234
	 * $query->filterByEventType(array(12, 34)); // WHERE event_type IN (12, 34)
	 * $query->filterByEventType(array('min' => 12)); // WHERE event_type > 12
	 * </code>
	 *
	 * @param     mixed $eventType The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    EventQuery The current query, for fluid interface
	 */
	public function filterByEventType($eventType = null, $comparison = null)
	{
		if (is_array($eventType)) {
			$useMinMax = false;
			if (isset($eventType['min'])) {
				$this->addUsingAlias(EventPeer::EVENT_TYPE, $eventType['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($eventType['max'])) {
				$this->addUsingAlias(EventPeer::EVENT_TYPE, $eventType['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(EventPeer::EVENT_TYPE, $eventType, $comparison);
	}

	/**
	 * Filter the query on the location column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByLocation('fooValue');   // WHERE location = 'fooValue'
	 * $query->filterByLocation('%fooValue%'); // WHERE location LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $location The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    EventQuery The current query, for fluid interface
	 */
	public function filterByLocation($location = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($location)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $location)) {
				$location = str_replace('*', '%', $location);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(EventPeer::LOCATION, $location, $comparison);
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
	 * @return    EventQuery The current query, for fluid interface
	 */
	public function filterByPrice($price = null, $comparison = null)
	{
		if (is_array($price)) {
			$useMinMax = false;
			if (isset($price['min'])) {
				$this->addUsingAlias(EventPeer::PRICE, $price['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($price['max'])) {
				$this->addUsingAlias(EventPeer::PRICE, $price['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(EventPeer::PRICE, $price, $comparison);
	}

	/**
	 * Filter the query on the event_date column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByEventDate('2011-03-14'); // WHERE event_date = '2011-03-14'
	 * $query->filterByEventDate('now'); // WHERE event_date = '2011-03-14'
	 * $query->filterByEventDate(array('max' => 'yesterday')); // WHERE event_date > '2011-03-13'
	 * </code>
	 *
	 * @param     mixed $eventDate The value to use as filter.
	 *              Values can be integers (unix timestamps), DateTime objects, or strings.
	 *              Empty strings are treated as NULL.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    EventQuery The current query, for fluid interface
	 */
	public function filterByEventDate($eventDate = null, $comparison = null)
	{
		if (is_array($eventDate)) {
			$useMinMax = false;
			if (isset($eventDate['min'])) {
				$this->addUsingAlias(EventPeer::EVENT_DATE, $eventDate['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($eventDate['max'])) {
				$this->addUsingAlias(EventPeer::EVENT_DATE, $eventDate['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(EventPeer::EVENT_DATE, $eventDate, $comparison);
	}

	/**
	 * Filter the query on the code column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByCode('fooValue');   // WHERE code = 'fooValue'
	 * $query->filterByCode('%fooValue%'); // WHERE code LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $code The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    EventQuery The current query, for fluid interface
	 */
	public function filterByCode($code = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($code)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $code)) {
				$code = str_replace('*', '%', $code);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(EventPeer::CODE, $code, $comparison);
	}

	/**
	 * Filter the query on the ticket_url column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByTicketUrl('fooValue');   // WHERE ticket_url = 'fooValue'
	 * $query->filterByTicketUrl('%fooValue%'); // WHERE ticket_url LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $ticketUrl The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    EventQuery The current query, for fluid interface
	 */
	public function filterByTicketUrl($ticketUrl = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($ticketUrl)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $ticketUrl)) {
				$ticketUrl = str_replace('*', '%', $ticketUrl);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(EventPeer::TICKET_URL, $ticketUrl, $comparison);
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
	 * @return    EventQuery The current query, for fluid interface
	 */
	public function filterByPdate($pdate = null, $comparison = null)
	{
		if (is_array($pdate)) {
			$useMinMax = false;
			if (isset($pdate['min'])) {
				$this->addUsingAlias(EventPeer::PDATE, $pdate['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($pdate['max'])) {
				$this->addUsingAlias(EventPeer::PDATE, $pdate['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(EventPeer::PDATE, $pdate, $comparison);
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
	 * @return    EventQuery The current query, for fluid interface
	 */
	public function filterByStatus($status = null, $comparison = null)
	{
		if (is_array($status)) {
			$useMinMax = false;
			if (isset($status['min'])) {
				$this->addUsingAlias(EventPeer::STATUS, $status['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($status['max'])) {
				$this->addUsingAlias(EventPeer::STATUS, $status['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(EventPeer::STATUS, $status, $comparison);
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
	 * @return    EventQuery The current query, for fluid interface
	 */
	public function filterByDeleted($deleted = null, $comparison = null)
	{
		if (is_array($deleted)) {
			$useMinMax = false;
			if (isset($deleted['min'])) {
				$this->addUsingAlias(EventPeer::DELETED, $deleted['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($deleted['max'])) {
				$this->addUsingAlias(EventPeer::DELETED, $deleted['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(EventPeer::DELETED, $deleted, $comparison);
	}
	
	/**
	 * Filter the query on the event_photo column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByEventPhoto('fooValue');   // WHERE event_photo = 'fooValue'
	 * $query->filterByEventPhoto('%fooValue%'); // WHERE event_photo LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $eventPhoto The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    EventQuery The current query, for fluid interface
	 */
	public function filterByEventPhoto($eventPhoto = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($eventPhoto)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $eventPhoto)) {
				$eventPhoto = str_replace('*', '%', $eventPhoto);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(EventPeer::EVENT_PHOTO, $eventPhoto, $comparison);
	}


	/**
	 * Filter the query on the event_app column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByEventApp(1234); // WHERE event_app = 1234
	 * $query->filterByEventApp(array(12, 34)); // WHERE event_app IN (12, 34)
	 * $query->filterByEventApp(array('min' => 12)); // WHERE event_app > 12
	 * </code>
	 *
	 * @param     mixed $eventApp The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    EventQuery The current query, for fluid interface
	 */
	public function filterByEventApp($eventApp = null, $comparison = null)
	{
		if (is_array($eventApp)) {
			$useMinMax = false;
			if (isset($eventApp['min'])) {
				$this->addUsingAlias(EventPeer::EVENT_APP, $eventApp['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($eventApp['max'])) {
				$this->addUsingAlias(EventPeer::EVENT_APP, $eventApp['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(EventPeer::EVENT_APP, $eventApp, $comparison);
	}



	/**
	 * Filter the query on the duration column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByDuration(1234); // WHERE duration = 1234
	 * $query->filterByDuration(array(12, 34)); // WHERE duration IN (12, 34)
	 * $query->filterByDuration(array('min' => 12)); // WHERE duration > 12
	 * </code>
	 *
	 * @param     mixed $duration The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    EventQuery The current query, for fluid interface
	 */
	public function filterByDuration($duration = null, $comparison = null)
	{
		if (is_array($duration)) {
			$useMinMax = false;
			if (isset($duration['min'])) {
				$this->addUsingAlias(EventPeer::DURATION, $duration['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($duration['max'])) {
				$this->addUsingAlias(EventPeer::DURATION, $duration['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(EventPeer::DURATION, $duration, $comparison);
	}
	
	/**
	 * Filter the query by a related User object
	 *
	 * @param     User|PropelCollection $user The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    EventQuery The current query, for fluid interface
	 */
	public function filterByUser($user, $comparison = null)
	{
		if ($user instanceof User) {
			return $this
				->addUsingAlias(EventPeer::USER_ID, $user->getId(), $comparison);
		} elseif ($user instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(EventPeer::USER_ID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
	 * @return    EventQuery The current query, for fluid interface
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
	 * Filter the query by a related EventAttend object
	 *
	 * @param     EventAttend $eventAttend  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    EventQuery The current query, for fluid interface
	 */
	public function filterByEventAttend($eventAttend, $comparison = null)
	{
		if ($eventAttend instanceof EventAttend) {
			return $this
				->addUsingAlias(EventPeer::ID, $eventAttend->getEventId(), $comparison);
		} elseif ($eventAttend instanceof PropelCollection) {
			return $this
				->useEventAttendQuery()
				->filterByPrimaryKeys($eventAttend->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByEventAttend() only accepts arguments of type EventAttend or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the EventAttend relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    EventQuery The current query, for fluid interface
	 */
	public function joinEventAttend($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('EventAttend');

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
			$this->addJoinObject($join, 'EventAttend');
		}

		return $this;
	}

	/**
	 * Use the EventAttend relation EventAttend object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    EventAttendQuery A secondary query class using the current class as primary query
	 */
	public function useEventAttendQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinEventAttend($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'EventAttend', 'EventAttendQuery');
	}

	/**
	 * Filter the query by a related EventPurchase object
	 *
	 * @param     EventPurchase $eventPurchase  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    EventQuery The current query, for fluid interface
	 */
	public function filterByEventPurchase($eventPurchase, $comparison = null)
	{
		if ($eventPurchase instanceof EventPurchase) {
			return $this
				->addUsingAlias(EventPeer::ID, $eventPurchase->getEventId(), $comparison);
		} elseif ($eventPurchase instanceof PropelCollection) {
			return $this
				->useEventPurchaseQuery()
				->filterByPrimaryKeys($eventPurchase->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByEventPurchase() only accepts arguments of type EventPurchase or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the EventPurchase relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    EventQuery The current query, for fluid interface
	 */
	public function joinEventPurchase($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('EventPurchase');

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
			$this->addJoinObject($join, 'EventPurchase');
		}

		return $this;
	}

	/**
	 * Use the EventPurchase relation EventPurchase object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    EventPurchaseQuery A secondary query class using the current class as primary query
	 */
	public function useEventPurchaseQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinEventPurchase($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'EventPurchase', 'EventPurchaseQuery');
	}

	/**
	 * Filter the query by a related EventVideo object
	 *
	 * @param     EventVideo $eventVideo  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    EventQuery The current query, for fluid interface
	 */
	public function filterByEventVideo($eventVideo, $comparison = null)
	{
		if ($eventVideo instanceof EventVideo) {
			return $this
				->addUsingAlias(EventPeer::ID, $eventVideo->getEventId(), $comparison);
		} elseif ($eventVideo instanceof PropelCollection) {
			return $this
				->useEventVideoQuery()
				->filterByPrimaryKeys($eventVideo->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByEventVideo() only accepts arguments of type EventVideo or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the EventVideo relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    EventQuery The current query, for fluid interface
	 */
	public function joinEventVideo($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('EventVideo');

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
			$this->addJoinObject($join, 'EventVideo');
		}

		return $this;
	}

	/**
	 * Use the EventVideo relation EventVideo object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    EventVideoQuery A secondary query class using the current class as primary query
	 */
	public function useEventVideoQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinEventVideo($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'EventVideo', 'EventVideoQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Event $event Object to remove from the list of results
	 *
	 * @return    EventQuery The current query, for fluid interface
	 */
	public function prune($event = null)
	{
		if ($event) {
			$this->addUsingAlias(EventPeer::ID, $event->getId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseEventQuery