<?php


/**
 * Base class that represents a query for the 'comment' table.
 *
 * 
 *
 * @method     CommentQuery orderByCmtId($order = Criteria::ASC) Order by the cmt_id column
 * @method     CommentQuery orderByCmtUserId($order = Criteria::ASC) Order by the cmt_user_id column
 * @method     CommentQuery orderByCmtReferType($order = Criteria::ASC) Order by the cmt_refer_type column
 * @method     CommentQuery orderByCmtReferId($order = Criteria::ASC) Order by the cmt_refer_id column
 * @method     CommentQuery orderByCmtMessage($order = Criteria::ASC) Order by the cmt_message column
 * @method     CommentQuery orderByCmtDate($order = Criteria::ASC) Order by the cmt_date column
 * @method     CommentQuery orderByCmtStatus($order = Criteria::ASC) Order by the cmt_status column
 *
 * @method     CommentQuery groupByCmtId() Group by the cmt_id column
 * @method     CommentQuery groupByCmtUserId() Group by the cmt_user_id column
 * @method     CommentQuery groupByCmtReferType() Group by the cmt_refer_type column
 * @method     CommentQuery groupByCmtReferId() Group by the cmt_refer_id column
 * @method     CommentQuery groupByCmtMessage() Group by the cmt_message column
 * @method     CommentQuery groupByCmtDate() Group by the cmt_date column
 * @method     CommentQuery groupByCmtStatus() Group by the cmt_status column
 *
 * @method     CommentQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     CommentQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     CommentQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     CommentQuery leftJoinUserFromK($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserFromK relation
 * @method     CommentQuery rightJoinUserFromK($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserFromK relation
 * @method     CommentQuery innerJoinUserFromK($relationAlias = null) Adds a INNER JOIN clause to the query using the UserFromK relation
 *
 * @method     Comment findOne(PropelPDO $con = null) Return the first Comment matching the query
 * @method     Comment findOneOrCreate(PropelPDO $con = null) Return the first Comment matching the query, or a new Comment object populated from the query conditions when no match is found
 *
 * @method     Comment findOneByCmtId(int $cmt_id) Return the first Comment filtered by the cmt_id column
 * @method     Comment findOneByCmtUserId(int $cmt_user_id) Return the first Comment filtered by the cmt_user_id column
 * @method     Comment findOneByCmtReferType(int $cmt_refer_type) Return the first Comment filtered by the cmt_refer_type column
 * @method     Comment findOneByCmtReferId(int $cmt_refer_id) Return the first Comment filtered by the cmt_refer_id column
 * @method     Comment findOneByCmtMessage(string $cmt_message) Return the first Comment filtered by the cmt_message column
 * @method     Comment findOneByCmtDate(int $cmt_date) Return the first Comment filtered by the cmt_date column
 * @method     Comment findOneByCmtStatus(int $cmt_status) Return the first Comment filtered by the cmt_status column
 *
 * @method     array findByCmtId(int $cmt_id) Return Comment objects filtered by the cmt_id column
 * @method     array findByCmtUserId(int $cmt_user_id) Return Comment objects filtered by the cmt_user_id column
 * @method     array findByCmtReferType(int $cmt_refer_type) Return Comment objects filtered by the cmt_refer_type column
 * @method     array findByCmtReferId(int $cmt_refer_id) Return Comment objects filtered by the cmt_refer_id column
 * @method     array findByCmtMessage(string $cmt_message) Return Comment objects filtered by the cmt_message column
 * @method     array findByCmtDate(int $cmt_date) Return Comment objects filtered by the cmt_date column
 * @method     array findByCmtStatus(int $cmt_status) Return Comment objects filtered by the cmt_status column
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BaseCommentQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseCommentQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'artistfan', $modelName = 'Comment', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new CommentQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    CommentQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof CommentQuery) {
			return $criteria;
		}
		$query = new CommentQuery();
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
	 * @return    Comment|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = CommentPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(CommentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    Comment A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `CMT_ID`, `CMT_USER_ID`, `CMT_REFER_TYPE`, `CMT_REFER_ID`, `CMT_MESSAGE`, `CMT_DATE`, `CMT_STATUS` FROM `comment` WHERE `CMT_ID` = :p0';
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
			$obj = new Comment();
			$obj->hydrate($row);
			CommentPeer::addInstanceToPool($obj, (string) $row[0]);
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
	 * @return    Comment|array|mixed the result, formatted by the current formatter
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
	 * @return    CommentQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(CommentPeer::CMT_ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    CommentQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(CommentPeer::CMT_ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the cmt_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByCmtId(1234); // WHERE cmt_id = 1234
	 * $query->filterByCmtId(array(12, 34)); // WHERE cmt_id IN (12, 34)
	 * $query->filterByCmtId(array('min' => 12)); // WHERE cmt_id > 12
	 * </code>
	 *
	 * @param     mixed $cmtId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CommentQuery The current query, for fluid interface
	 */
	public function filterByCmtId($cmtId = null, $comparison = null)
	{
		if (is_array($cmtId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(CommentPeer::CMT_ID, $cmtId, $comparison);
	}

	/**
	 * Filter the query on the cmt_user_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByCmtUserId(1234); // WHERE cmt_user_id = 1234
	 * $query->filterByCmtUserId(array(12, 34)); // WHERE cmt_user_id IN (12, 34)
	 * $query->filterByCmtUserId(array('min' => 12)); // WHERE cmt_user_id > 12
	 * </code>
	 *
	 * @see       filterByUserFromK()
	 *
	 * @param     mixed $cmtUserId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CommentQuery The current query, for fluid interface
	 */
	public function filterByCmtUserId($cmtUserId = null, $comparison = null)
	{
		if (is_array($cmtUserId)) {
			$useMinMax = false;
			if (isset($cmtUserId['min'])) {
				$this->addUsingAlias(CommentPeer::CMT_USER_ID, $cmtUserId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($cmtUserId['max'])) {
				$this->addUsingAlias(CommentPeer::CMT_USER_ID, $cmtUserId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(CommentPeer::CMT_USER_ID, $cmtUserId, $comparison);
	}

	/**
	 * Filter the query on the cmt_refer_type column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByCmtReferType(1234); // WHERE cmt_refer_type = 1234
	 * $query->filterByCmtReferType(array(12, 34)); // WHERE cmt_refer_type IN (12, 34)
	 * $query->filterByCmtReferType(array('min' => 12)); // WHERE cmt_refer_type > 12
	 * </code>
	 *
	 * @param     mixed $cmtReferType The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CommentQuery The current query, for fluid interface
	 */
	public function filterByCmtReferType($cmtReferType = null, $comparison = null)
	{
		if (is_array($cmtReferType)) {
			$useMinMax = false;
			if (isset($cmtReferType['min'])) {
				$this->addUsingAlias(CommentPeer::CMT_REFER_TYPE, $cmtReferType['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($cmtReferType['max'])) {
				$this->addUsingAlias(CommentPeer::CMT_REFER_TYPE, $cmtReferType['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(CommentPeer::CMT_REFER_TYPE, $cmtReferType, $comparison);
	}

	/**
	 * Filter the query on the cmt_refer_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByCmtReferId(1234); // WHERE cmt_refer_id = 1234
	 * $query->filterByCmtReferId(array(12, 34)); // WHERE cmt_refer_id IN (12, 34)
	 * $query->filterByCmtReferId(array('min' => 12)); // WHERE cmt_refer_id > 12
	 * </code>
	 *
	 * @param     mixed $cmtReferId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CommentQuery The current query, for fluid interface
	 */
	public function filterByCmtReferId($cmtReferId = null, $comparison = null)
	{
		if (is_array($cmtReferId)) {
			$useMinMax = false;
			if (isset($cmtReferId['min'])) {
				$this->addUsingAlias(CommentPeer::CMT_REFER_ID, $cmtReferId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($cmtReferId['max'])) {
				$this->addUsingAlias(CommentPeer::CMT_REFER_ID, $cmtReferId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(CommentPeer::CMT_REFER_ID, $cmtReferId, $comparison);
	}

	/**
	 * Filter the query on the cmt_message column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByCmtMessage('fooValue');   // WHERE cmt_message = 'fooValue'
	 * $query->filterByCmtMessage('%fooValue%'); // WHERE cmt_message LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $cmtMessage The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CommentQuery The current query, for fluid interface
	 */
	public function filterByCmtMessage($cmtMessage = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($cmtMessage)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $cmtMessage)) {
				$cmtMessage = str_replace('*', '%', $cmtMessage);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(CommentPeer::CMT_MESSAGE, $cmtMessage, $comparison);
	}

	/**
	 * Filter the query on the cmt_date column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByCmtDate(1234); // WHERE cmt_date = 1234
	 * $query->filterByCmtDate(array(12, 34)); // WHERE cmt_date IN (12, 34)
	 * $query->filterByCmtDate(array('min' => 12)); // WHERE cmt_date > 12
	 * </code>
	 *
	 * @param     mixed $cmtDate The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CommentQuery The current query, for fluid interface
	 */
	public function filterByCmtDate($cmtDate = null, $comparison = null)
	{
		if (is_array($cmtDate)) {
			$useMinMax = false;
			if (isset($cmtDate['min'])) {
				$this->addUsingAlias(CommentPeer::CMT_DATE, $cmtDate['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($cmtDate['max'])) {
				$this->addUsingAlias(CommentPeer::CMT_DATE, $cmtDate['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(CommentPeer::CMT_DATE, $cmtDate, $comparison);
	}

	/**
	 * Filter the query on the cmt_status column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByCmtStatus(1234); // WHERE cmt_status = 1234
	 * $query->filterByCmtStatus(array(12, 34)); // WHERE cmt_status IN (12, 34)
	 * $query->filterByCmtStatus(array('min' => 12)); // WHERE cmt_status > 12
	 * </code>
	 *
	 * @param     mixed $cmtStatus The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CommentQuery The current query, for fluid interface
	 */
	public function filterByCmtStatus($cmtStatus = null, $comparison = null)
	{
		if (is_array($cmtStatus)) {
			$useMinMax = false;
			if (isset($cmtStatus['min'])) {
				$this->addUsingAlias(CommentPeer::CMT_STATUS, $cmtStatus['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($cmtStatus['max'])) {
				$this->addUsingAlias(CommentPeer::CMT_STATUS, $cmtStatus['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(CommentPeer::CMT_STATUS, $cmtStatus, $comparison);
	}

	/**
	 * Filter the query by a related User object
	 *
	 * @param     User|PropelCollection $user The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CommentQuery The current query, for fluid interface
	 */
	public function filterByUserFromK($user, $comparison = null)
	{
		if ($user instanceof User) {
			return $this
				->addUsingAlias(CommentPeer::CMT_USER_ID, $user->getId(), $comparison);
		} elseif ($user instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(CommentPeer::CMT_USER_ID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByUserFromK() only accepts arguments of type User or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the UserFromK relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    CommentQuery The current query, for fluid interface
	 */
	public function joinUserFromK($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('UserFromK');

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
			$this->addJoinObject($join, 'UserFromK');
		}

		return $this;
	}

	/**
	 * Use the UserFromK relation User object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    UserQuery A secondary query class using the current class as primary query
	 */
	public function useUserFromKQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinUserFromK($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'UserFromK', 'UserQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Comment $comment Object to remove from the list of results
	 *
	 * @return    CommentQuery The current query, for fluid interface
	 */
	public function prune($comment = null)
	{
		if ($comment) {
			$this->addUsingAlias(CommentPeer::CMT_ID, $comment->getCmtId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseCommentQuery