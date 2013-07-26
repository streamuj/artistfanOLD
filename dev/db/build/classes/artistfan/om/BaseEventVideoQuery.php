<?php


/**
 * Base class that represents a query for the 'event_video' table.
 *
 * 
 *
 * @method     EventVideoQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     EventVideoQuery orderByEventId($order = Criteria::ASC) Order by the event_id column
 * @method     EventVideoQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     EventVideoQuery orderByVideo($order = Criteria::ASC) Order by the video column
 * @method     EventVideoQuery orderByOrder($order = Criteria::ASC) Order by the order column
 * @method     EventVideoQuery orderByPdate($order = Criteria::ASC) Order by the pdate column
 *
 * @method     EventVideoQuery groupById() Group by the id column
 * @method     EventVideoQuery groupByEventId() Group by the event_id column
 * @method     EventVideoQuery groupByUserId() Group by the user_id column
 * @method     EventVideoQuery groupByVideo() Group by the video column
 * @method     EventVideoQuery groupByOrder() Group by the order column
 * @method     EventVideoQuery groupByPdate() Group by the pdate column
 *
 * @method     EventVideoQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     EventVideoQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     EventVideoQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     EventVideoQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     EventVideoQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     EventVideoQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     EventVideoQuery leftJoinEvent($relationAlias = null) Adds a LEFT JOIN clause to the query using the Event relation
 * @method     EventVideoQuery rightJoinEvent($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Event relation
 * @method     EventVideoQuery innerJoinEvent($relationAlias = null) Adds a INNER JOIN clause to the query using the Event relation
 *
 * @method     EventVideo findOne(PropelPDO $con = null) Return the first EventVideo matching the query
 * @method     EventVideo findOneOrCreate(PropelPDO $con = null) Return the first EventVideo matching the query, or a new EventVideo object populated from the query conditions when no match is found
 *
 * @method     EventVideo findOneById(int $id) Return the first EventVideo filtered by the id column
 * @method     EventVideo findOneByEventId(int $event_id) Return the first EventVideo filtered by the event_id column
 * @method     EventVideo findOneByUserId(int $user_id) Return the first EventVideo filtered by the user_id column
 * @method     EventVideo findOneByVideo(string $video) Return the first EventVideo filtered by the video column
 * @method     EventVideo findOneByOrder(int $order) Return the first EventVideo filtered by the order column
 * @method     EventVideo findOneByPdate(int $pdate) Return the first EventVideo filtered by the pdate column
 *
 * @method     array findById(int $id) Return EventVideo objects filtered by the id column
 * @method     array findByEventId(int $event_id) Return EventVideo objects filtered by the event_id column
 * @method     array findByUserId(int $user_id) Return EventVideo objects filtered by the user_id column
 * @method     array findByVideo(string $video) Return EventVideo objects filtered by the video column
 * @method     array findByOrder(int $order) Return EventVideo objects filtered by the order column
 * @method     array findByPdate(int $pdate) Return EventVideo objects filtered by the pdate column
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BaseEventVideoQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseEventVideoQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'artistfan', $modelName = 'EventVideo', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new EventVideoQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    EventVideoQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof EventVideoQuery) {
			return $criteria;
		}
		$query = new EventVideoQuery();
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
	 * @return    EventVideo|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = EventVideoPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(EventVideoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    EventVideo A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ID`, `EVENT_ID`, `USER_ID`, `VIDEO`, `ORDER`, `PDATE` FROM `event_video` WHERE `ID` = :p0';
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
			$obj = new EventVideo();
			$obj->hydrate($row);
			EventVideoPeer::addInstanceToPool($obj, (string) $key);
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
	 * @return    EventVideo|array|mixed the result, formatted by the current formatter
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
	 * @return    EventVideoQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(EventVideoPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    EventVideoQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(EventVideoPeer::ID, $keys, Criteria::IN);
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
	 * @return    EventVideoQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(EventVideoPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the event_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByEventId(1234); // WHERE event_id = 1234
	 * $query->filterByEventId(array(12, 34)); // WHERE event_id IN (12, 34)
	 * $query->filterByEventId(array('min' => 12)); // WHERE event_id > 12
	 * </code>
	 *
	 * @see       filterByEvent()
	 *
	 * @param     mixed $eventId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    EventVideoQuery The current query, for fluid interface
	 */
	public function filterByEventId($eventId = null, $comparison = null)
	{
		if (is_array($eventId)) {
			$useMinMax = false;
			if (isset($eventId['min'])) {
				$this->addUsingAlias(EventVideoPeer::EVENT_ID, $eventId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($eventId['max'])) {
				$this->addUsingAlias(EventVideoPeer::EVENT_ID, $eventId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(EventVideoPeer::EVENT_ID, $eventId, $comparison);
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
	 * @return    EventVideoQuery The current query, for fluid interface
	 */
	public function filterByUserId($userId = null, $comparison = null)
	{
		if (is_array($userId)) {
			$useMinMax = false;
			if (isset($userId['min'])) {
				$this->addUsingAlias(EventVideoPeer::USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($userId['max'])) {
				$this->addUsingAlias(EventVideoPeer::USER_ID, $userId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(EventVideoPeer::USER_ID, $userId, $comparison);
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
	 * @return    EventVideoQuery The current query, for fluid interface
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
		return $this->addUsingAlias(EventVideoPeer::VIDEO, $video, $comparison);
	}

	/**
	 * Filter the query on the order column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByOrder(1234); // WHERE order = 1234
	 * $query->filterByOrder(array(12, 34)); // WHERE order IN (12, 34)
	 * $query->filterByOrder(array('min' => 12)); // WHERE order > 12
	 * </code>
	 *
	 * @param     mixed $order The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    EventVideoQuery The current query, for fluid interface
	 */
	public function filterByOrder($order = null, $comparison = null)
	{
		if (is_array($order)) {
			$useMinMax = false;
			if (isset($order['min'])) {
				$this->addUsingAlias(EventVideoPeer::ORDER, $order['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($order['max'])) {
				$this->addUsingAlias(EventVideoPeer::ORDER, $order['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(EventVideoPeer::ORDER, $order, $comparison);
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
	 * @return    EventVideoQuery The current query, for fluid interface
	 */
	public function filterByPdate($pdate = null, $comparison = null)
	{
		if (is_array($pdate)) {
			$useMinMax = false;
			if (isset($pdate['min'])) {
				$this->addUsingAlias(EventVideoPeer::PDATE, $pdate['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($pdate['max'])) {
				$this->addUsingAlias(EventVideoPeer::PDATE, $pdate['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(EventVideoPeer::PDATE, $pdate, $comparison);
	}

	/**
	 * Filter the query by a related User object
	 *
	 * @param     User|PropelCollection $user The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    EventVideoQuery The current query, for fluid interface
	 */
	public function filterByUser($user, $comparison = null)
	{
		if ($user instanceof User) {
			return $this
				->addUsingAlias(EventVideoPeer::USER_ID, $user->getId(), $comparison);
		} elseif ($user instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(EventVideoPeer::USER_ID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
	 * @return    EventVideoQuery The current query, for fluid interface
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
	 * Filter the query by a related Event object
	 *
	 * @param     Event|PropelCollection $event The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    EventVideoQuery The current query, for fluid interface
	 */
	public function filterByEvent($event, $comparison = null)
	{
		if ($event instanceof Event) {
			return $this
				->addUsingAlias(EventVideoPeer::EVENT_ID, $event->getId(), $comparison);
		} elseif ($event instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(EventVideoPeer::EVENT_ID, $event->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByEvent() only accepts arguments of type Event or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Event relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    EventVideoQuery The current query, for fluid interface
	 */
	public function joinEvent($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Event');

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
			$this->addJoinObject($join, 'Event');
		}

		return $this;
	}

	/**
	 * Use the Event relation Event object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    EventQuery A secondary query class using the current class as primary query
	 */
	public function useEventQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinEvent($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Event', 'EventQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     EventVideo $eventVideo Object to remove from the list of results
	 *
	 * @return    EventVideoQuery The current query, for fluid interface
	 */
	public function prune($eventVideo = null)
	{
		if ($eventVideo) {
			$this->addUsingAlias(EventVideoPeer::ID, $eventVideo->getId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseEventVideoQuery