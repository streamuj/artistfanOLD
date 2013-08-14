<?php


/**
 * Base class that represents a query for the 'broadcast_flows' table.
 *
 * 
 *
 * @method     BroadcastFlowsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     BroadcastFlowsQuery orderByEventId($order = Criteria::ASC) Order by the event_id column
 * @method     BroadcastFlowsQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     BroadcastFlowsQuery orderByPdate($order = Criteria::ASC) Order by the pdate column
 * @method     BroadcastFlowsQuery orderByFlow($order = Criteria::ASC) Order by the flow column
 * @method     BroadcastFlowsQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     BroadcastFlowsQuery orderByUsed($order = Criteria::ASC) Order by the used column
 *
 * @method     BroadcastFlowsQuery groupById() Group by the id column
 * @method     BroadcastFlowsQuery groupByEventId() Group by the event_id column
 * @method     BroadcastFlowsQuery groupByUserId() Group by the user_id column
 * @method     BroadcastFlowsQuery groupByPdate() Group by the pdate column
 * @method     BroadcastFlowsQuery groupByFlow() Group by the flow column
 * @method     BroadcastFlowsQuery groupByStatus() Group by the status column
 * @method     BroadcastFlowsQuery groupByUsed() Group by the used column
 *
 * @method     BroadcastFlowsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     BroadcastFlowsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     BroadcastFlowsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     BroadcastFlowsQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     BroadcastFlowsQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     BroadcastFlowsQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     BroadcastFlows findOne(PropelPDO $con = null) Return the first BroadcastFlows matching the query
 * @method     BroadcastFlows findOneOrCreate(PropelPDO $con = null) Return the first BroadcastFlows matching the query, or a new BroadcastFlows object populated from the query conditions when no match is found
 *
 * @method     BroadcastFlows findOneById(int $id) Return the first BroadcastFlows filtered by the id column
 * @method     BroadcastFlows findOneByEventId(int $event_id) Return the first BroadcastFlows filtered by the event_id column
 * @method     BroadcastFlows findOneByUserId(int $user_id) Return the first BroadcastFlows filtered by the user_id column
 * @method     BroadcastFlows findOneByPdate(int $pdate) Return the first BroadcastFlows filtered by the pdate column
 * @method     BroadcastFlows findOneByFlow(string $flow) Return the first BroadcastFlows filtered by the flow column
 * @method     BroadcastFlows findOneByStatus(int $status) Return the first BroadcastFlows filtered by the status column
 * @method     BroadcastFlows findOneByUsed(int $used) Return the first BroadcastFlows filtered by the used column
 *
 * @method     array findById(int $id) Return BroadcastFlows objects filtered by the id column
 * @method     array findByEventId(int $event_id) Return BroadcastFlows objects filtered by the event_id column
 * @method     array findByUserId(int $user_id) Return BroadcastFlows objects filtered by the user_id column
 * @method     array findByPdate(int $pdate) Return BroadcastFlows objects filtered by the pdate column
 * @method     array findByFlow(string $flow) Return BroadcastFlows objects filtered by the flow column
 * @method     array findByStatus(int $status) Return BroadcastFlows objects filtered by the status column
 * @method     array findByUsed(int $used) Return BroadcastFlows objects filtered by the used column
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BaseBroadcastFlowsQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseBroadcastFlowsQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'artistfan', $modelName = 'BroadcastFlows', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new BroadcastFlowsQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    BroadcastFlowsQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof BroadcastFlowsQuery) {
			return $criteria;
		}
		$query = new BroadcastFlowsQuery();
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
	 * @return    BroadcastFlows|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = BroadcastFlowsPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(BroadcastFlowsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    BroadcastFlows A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ID`, `EVENT_ID`, `USER_ID`, `PDATE`, `FLOW`, `STATUS`, `USED` FROM `broadcast_flows` WHERE `ID` = :p0';
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
			$obj = new BroadcastFlows();
			$obj->hydrate($row);
			BroadcastFlowsPeer::addInstanceToPool($obj, (string) $key);
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
	 * @return    BroadcastFlows|array|mixed the result, formatted by the current formatter
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
	 * @return    BroadcastFlowsQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(BroadcastFlowsPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    BroadcastFlowsQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(BroadcastFlowsPeer::ID, $keys, Criteria::IN);
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
	 * @return    BroadcastFlowsQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(BroadcastFlowsPeer::ID, $id, $comparison);
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
	 * @param     mixed $eventId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    BroadcastFlowsQuery The current query, for fluid interface
	 */
	public function filterByEventId($eventId = null, $comparison = null)
	{
		if (is_array($eventId)) {
			$useMinMax = false;
			if (isset($eventId['min'])) {
				$this->addUsingAlias(BroadcastFlowsPeer::EVENT_ID, $eventId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($eventId['max'])) {
				$this->addUsingAlias(BroadcastFlowsPeer::EVENT_ID, $eventId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(BroadcastFlowsPeer::EVENT_ID, $eventId, $comparison);
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
	 * @return    BroadcastFlowsQuery The current query, for fluid interface
	 */
	public function filterByUserId($userId = null, $comparison = null)
	{
		if (is_array($userId)) {
			$useMinMax = false;
			if (isset($userId['min'])) {
				$this->addUsingAlias(BroadcastFlowsPeer::USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($userId['max'])) {
				$this->addUsingAlias(BroadcastFlowsPeer::USER_ID, $userId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(BroadcastFlowsPeer::USER_ID, $userId, $comparison);
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
	 * @return    BroadcastFlowsQuery The current query, for fluid interface
	 */
	public function filterByPdate($pdate = null, $comparison = null)
	{
		if (is_array($pdate)) {
			$useMinMax = false;
			if (isset($pdate['min'])) {
				$this->addUsingAlias(BroadcastFlowsPeer::PDATE, $pdate['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($pdate['max'])) {
				$this->addUsingAlias(BroadcastFlowsPeer::PDATE, $pdate['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(BroadcastFlowsPeer::PDATE, $pdate, $comparison);
	}

	/**
	 * Filter the query on the flow column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByFlow('fooValue');   // WHERE flow = 'fooValue'
	 * $query->filterByFlow('%fooValue%'); // WHERE flow LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $flow The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    BroadcastFlowsQuery The current query, for fluid interface
	 */
	public function filterByFlow($flow = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($flow)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $flow)) {
				$flow = str_replace('*', '%', $flow);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(BroadcastFlowsPeer::FLOW, $flow, $comparison);
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
	 * @return    BroadcastFlowsQuery The current query, for fluid interface
	 */
	public function filterByStatus($status = null, $comparison = null)
	{
		if (is_array($status)) {
			$useMinMax = false;
			if (isset($status['min'])) {
				$this->addUsingAlias(BroadcastFlowsPeer::STATUS, $status['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($status['max'])) {
				$this->addUsingAlias(BroadcastFlowsPeer::STATUS, $status['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(BroadcastFlowsPeer::STATUS, $status, $comparison);
	}

	/**
	 * Filter the query on the used column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByUsed(1234); // WHERE used = 1234
	 * $query->filterByUsed(array(12, 34)); // WHERE used IN (12, 34)
	 * $query->filterByUsed(array('min' => 12)); // WHERE used > 12
	 * </code>
	 *
	 * @param     mixed $used The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    BroadcastFlowsQuery The current query, for fluid interface
	 */
	public function filterByUsed($used = null, $comparison = null)
	{
		if (is_array($used)) {
			$useMinMax = false;
			if (isset($used['min'])) {
				$this->addUsingAlias(BroadcastFlowsPeer::USED, $used['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($used['max'])) {
				$this->addUsingAlias(BroadcastFlowsPeer::USED, $used['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(BroadcastFlowsPeer::USED, $used, $comparison);
	}

	/**
	 * Filter the query by a related User object
	 *
	 * @param     User|PropelCollection $user The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    BroadcastFlowsQuery The current query, for fluid interface
	 */
	public function filterByUser($user, $comparison = null)
	{
		if ($user instanceof User) {
			return $this
				->addUsingAlias(BroadcastFlowsPeer::USER_ID, $user->getId(), $comparison);
		} elseif ($user instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(BroadcastFlowsPeer::USER_ID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
	 * @return    BroadcastFlowsQuery The current query, for fluid interface
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
	 * @param     BroadcastFlows $broadcastFlows Object to remove from the list of results
	 *
	 * @return    BroadcastFlowsQuery The current query, for fluid interface
	 */
	public function prune($broadcastFlows = null)
	{
		if ($broadcastFlows) {
			$this->addUsingAlias(BroadcastFlowsPeer::ID, $broadcastFlows->getId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseBroadcastFlowsQuery