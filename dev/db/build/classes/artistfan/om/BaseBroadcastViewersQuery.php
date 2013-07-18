<?php


/**
 * Base class that represents a query for the 'broadcast_viewers' table.
 *
 * 
 *
 * @method     BroadcastViewersQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     BroadcastViewersQuery orderByEventId($order = Criteria::ASC) Order by the event_id column
 * @method     BroadcastViewersQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     BroadcastViewersQuery orderByPdate($order = Criteria::ASC) Order by the pdate column
 * @method     BroadcastViewersQuery orderByUdate($order = Criteria::ASC) Order by the udate column
 *
 * @method     BroadcastViewersQuery groupById() Group by the id column
 * @method     BroadcastViewersQuery groupByEventId() Group by the event_id column
 * @method     BroadcastViewersQuery groupByUserId() Group by the user_id column
 * @method     BroadcastViewersQuery groupByPdate() Group by the pdate column
 * @method     BroadcastViewersQuery groupByUdate() Group by the udate column
 *
 * @method     BroadcastViewersQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     BroadcastViewersQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     BroadcastViewersQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     BroadcastViewersQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     BroadcastViewersQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     BroadcastViewersQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     BroadcastViewers findOne(PropelPDO $con = null) Return the first BroadcastViewers matching the query
 * @method     BroadcastViewers findOneOrCreate(PropelPDO $con = null) Return the first BroadcastViewers matching the query, or a new BroadcastViewers object populated from the query conditions when no match is found
 *
 * @method     BroadcastViewers findOneById(int $id) Return the first BroadcastViewers filtered by the id column
 * @method     BroadcastViewers findOneByEventId(string $event_id) Return the first BroadcastViewers filtered by the event_id column
 * @method     BroadcastViewers findOneByUserId(int $user_id) Return the first BroadcastViewers filtered by the user_id column
 * @method     BroadcastViewers findOneByPdate(int $pdate) Return the first BroadcastViewers filtered by the pdate column
 * @method     BroadcastViewers findOneByUdate(int $udate) Return the first BroadcastViewers filtered by the udate column
 *
 * @method     array findById(int $id) Return BroadcastViewers objects filtered by the id column
 * @method     array findByEventId(string $event_id) Return BroadcastViewers objects filtered by the event_id column
 * @method     array findByUserId(int $user_id) Return BroadcastViewers objects filtered by the user_id column
 * @method     array findByPdate(int $pdate) Return BroadcastViewers objects filtered by the pdate column
 * @method     array findByUdate(int $udate) Return BroadcastViewers objects filtered by the udate column
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BaseBroadcastViewersQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseBroadcastViewersQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'artistfan', $modelName = 'BroadcastViewers', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new BroadcastViewersQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    BroadcastViewersQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof BroadcastViewersQuery) {
			return $criteria;
		}
		$query = new BroadcastViewersQuery();
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
	 * @return    BroadcastViewers|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = BroadcastViewersPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(BroadcastViewersPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    BroadcastViewers A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ID`, `EVENT_ID`, `USER_ID`, `PDATE`, `UDATE` FROM `broadcast_viewers` WHERE `ID` = :p0';
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
			$obj = new BroadcastViewers();
			$obj->hydrate($row);
			BroadcastViewersPeer::addInstanceToPool($obj, (string) $key);
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
	 * @return    BroadcastViewers|array|mixed the result, formatted by the current formatter
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
	 * @return    BroadcastViewersQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(BroadcastViewersPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    BroadcastViewersQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(BroadcastViewersPeer::ID, $keys, Criteria::IN);
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
	 * @return    BroadcastViewersQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(BroadcastViewersPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the event_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByEventId('fooValue');   // WHERE event_id = 'fooValue'
	 * $query->filterByEventId('%fooValue%'); // WHERE event_id LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $eventId The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    BroadcastViewersQuery The current query, for fluid interface
	 */
	public function filterByEventId($eventId = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($eventId)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $eventId)) {
				$eventId = str_replace('*', '%', $eventId);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(BroadcastViewersPeer::EVENT_ID, $eventId, $comparison);
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
	 * @return    BroadcastViewersQuery The current query, for fluid interface
	 */
	public function filterByUserId($userId = null, $comparison = null)
	{
		if (is_array($userId)) {
			$useMinMax = false;
			if (isset($userId['min'])) {
				$this->addUsingAlias(BroadcastViewersPeer::USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($userId['max'])) {
				$this->addUsingAlias(BroadcastViewersPeer::USER_ID, $userId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(BroadcastViewersPeer::USER_ID, $userId, $comparison);
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
	 * @return    BroadcastViewersQuery The current query, for fluid interface
	 */
	public function filterByPdate($pdate = null, $comparison = null)
	{
		if (is_array($pdate)) {
			$useMinMax = false;
			if (isset($pdate['min'])) {
				$this->addUsingAlias(BroadcastViewersPeer::PDATE, $pdate['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($pdate['max'])) {
				$this->addUsingAlias(BroadcastViewersPeer::PDATE, $pdate['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(BroadcastViewersPeer::PDATE, $pdate, $comparison);
	}

	/**
	 * Filter the query on the udate column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByUdate(1234); // WHERE udate = 1234
	 * $query->filterByUdate(array(12, 34)); // WHERE udate IN (12, 34)
	 * $query->filterByUdate(array('min' => 12)); // WHERE udate > 12
	 * </code>
	 *
	 * @param     mixed $udate The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    BroadcastViewersQuery The current query, for fluid interface
	 */
	public function filterByUdate($udate = null, $comparison = null)
	{
		if (is_array($udate)) {
			$useMinMax = false;
			if (isset($udate['min'])) {
				$this->addUsingAlias(BroadcastViewersPeer::UDATE, $udate['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($udate['max'])) {
				$this->addUsingAlias(BroadcastViewersPeer::UDATE, $udate['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(BroadcastViewersPeer::UDATE, $udate, $comparison);
	}

	/**
	 * Filter the query by a related User object
	 *
	 * @param     User|PropelCollection $user The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    BroadcastViewersQuery The current query, for fluid interface
	 */
	public function filterByUser($user, $comparison = null)
	{
		if ($user instanceof User) {
			return $this
				->addUsingAlias(BroadcastViewersPeer::USER_ID, $user->getId(), $comparison);
		} elseif ($user instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(BroadcastViewersPeer::USER_ID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
	 * @return    BroadcastViewersQuery The current query, for fluid interface
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
	 * Exclude object from result
	 *
	 * @param     BroadcastViewers $broadcastViewers Object to remove from the list of results
	 *
	 * @return    BroadcastViewersQuery The current query, for fluid interface
	 */
	public function prune($broadcastViewers = null)
	{
		if ($broadcastViewers) {
			$this->addUsingAlias(BroadcastViewersPeer::ID, $broadcastViewers->getId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseBroadcastViewersQuery