<?php


/**
 * Base class that represents a query for the 'email_template' table.
 *
 * 
 *
 * @method     EmailTemplateQuery orderByEtId($order = Criteria::ASC) Order by the et_id column
 * @method     EmailTemplateQuery orderByEtSubject($order = Criteria::ASC) Order by the et_subject column
 * @method     EmailTemplateQuery orderByEtMessage($order = Criteria::ASC) Order by the et_message column
 * @method     EmailTemplateQuery orderByEtType($order = Criteria::ASC) Order by the et_type column
 * @method     EmailTemplateQuery orderByEtMdate($order = Criteria::ASC) Order by the et_mdate column
 * @method     EmailTemplateQuery orderByEtUserId($order = Criteria::ASC) Order by the et_user_id column
 *
 * @method     EmailTemplateQuery groupByEtId() Group by the et_id column
 * @method     EmailTemplateQuery groupByEtSubject() Group by the et_subject column
 * @method     EmailTemplateQuery groupByEtMessage() Group by the et_message column
 * @method     EmailTemplateQuery groupByEtType() Group by the et_type column
 * @method     EmailTemplateQuery groupByEtMdate() Group by the et_mdate column
 * @method     EmailTemplateQuery groupByEtUserId() Group by the et_user_id column
 *
 * @method     EmailTemplateQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     EmailTemplateQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     EmailTemplateQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     EmailTemplate findOne(PropelPDO $con = null) Return the first EmailTemplate matching the query
 * @method     EmailTemplate findOneOrCreate(PropelPDO $con = null) Return the first EmailTemplate matching the query, or a new EmailTemplate object populated from the query conditions when no match is found
 *
 * @method     EmailTemplate findOneByEtId(int $et_id) Return the first EmailTemplate filtered by the et_id column
 * @method     EmailTemplate findOneByEtSubject(string $et_subject) Return the first EmailTemplate filtered by the et_subject column
 * @method     EmailTemplate findOneByEtMessage(string $et_message) Return the first EmailTemplate filtered by the et_message column
 * @method     EmailTemplate findOneByEtType(string $et_type) Return the first EmailTemplate filtered by the et_type column
 * @method     EmailTemplate findOneByEtMdate(int $et_mdate) Return the first EmailTemplate filtered by the et_mdate column
 * @method     EmailTemplate findOneByEtUserId(int $et_user_id) Return the first EmailTemplate filtered by the et_user_id column
 *
 * @method     array findByEtId(int $et_id) Return EmailTemplate objects filtered by the et_id column
 * @method     array findByEtSubject(string $et_subject) Return EmailTemplate objects filtered by the et_subject column
 * @method     array findByEtMessage(string $et_message) Return EmailTemplate objects filtered by the et_message column
 * @method     array findByEtType(string $et_type) Return EmailTemplate objects filtered by the et_type column
 * @method     array findByEtMdate(int $et_mdate) Return EmailTemplate objects filtered by the et_mdate column
 * @method     array findByEtUserId(int $et_user_id) Return EmailTemplate objects filtered by the et_user_id column
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BaseEmailTemplateQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseEmailTemplateQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'artistfan', $modelName = 'EmailTemplate', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new EmailTemplateQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    EmailTemplateQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof EmailTemplateQuery) {
			return $criteria;
		}
		$query = new EmailTemplateQuery();
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
	 * @return    EmailTemplate|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = EmailTemplatePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(EmailTemplatePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    EmailTemplate A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ET_ID`, `ET_SUBJECT`, `ET_MESSAGE`, `ET_TYPE`, `ET_MDATE`, `ET_USER_ID` FROM `email_template` WHERE `ET_ID` = :p0';
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
			$obj = new EmailTemplate();
			$obj->hydrate($row);
			EmailTemplatePeer::addInstanceToPool($obj, (string) $row[0]);
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
	 * @return    EmailTemplate|array|mixed the result, formatted by the current formatter
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
	 * @return    EmailTemplateQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(EmailTemplatePeer::ET_ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    EmailTemplateQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(EmailTemplatePeer::ET_ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the et_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByEtId(1234); // WHERE et_id = 1234
	 * $query->filterByEtId(array(12, 34)); // WHERE et_id IN (12, 34)
	 * $query->filterByEtId(array('min' => 12)); // WHERE et_id > 12
	 * </code>
	 *
	 * @param     mixed $etId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    EmailTemplateQuery The current query, for fluid interface
	 */
	public function filterByEtId($etId = null, $comparison = null)
	{
		if (is_array($etId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(EmailTemplatePeer::ET_ID, $etId, $comparison);
	}

	/**
	 * Filter the query on the et_subject column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByEtSubject('fooValue');   // WHERE et_subject = 'fooValue'
	 * $query->filterByEtSubject('%fooValue%'); // WHERE et_subject LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $etSubject The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    EmailTemplateQuery The current query, for fluid interface
	 */
	public function filterByEtSubject($etSubject = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($etSubject)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $etSubject)) {
				$etSubject = str_replace('*', '%', $etSubject);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(EmailTemplatePeer::ET_SUBJECT, $etSubject, $comparison);
	}

	/**
	 * Filter the query on the et_message column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByEtMessage('fooValue');   // WHERE et_message = 'fooValue'
	 * $query->filterByEtMessage('%fooValue%'); // WHERE et_message LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $etMessage The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    EmailTemplateQuery The current query, for fluid interface
	 */
	public function filterByEtMessage($etMessage = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($etMessage)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $etMessage)) {
				$etMessage = str_replace('*', '%', $etMessage);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(EmailTemplatePeer::ET_MESSAGE, $etMessage, $comparison);
	}

	/**
	 * Filter the query on the et_type column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByEtType('fooValue');   // WHERE et_type = 'fooValue'
	 * $query->filterByEtType('%fooValue%'); // WHERE et_type LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $etType The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    EmailTemplateQuery The current query, for fluid interface
	 */
	public function filterByEtType($etType = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($etType)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $etType)) {
				$etType = str_replace('*', '%', $etType);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(EmailTemplatePeer::ET_TYPE, $etType, $comparison);
	}

	/**
	 * Filter the query on the et_mdate column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByEtMdate(1234); // WHERE et_mdate = 1234
	 * $query->filterByEtMdate(array(12, 34)); // WHERE et_mdate IN (12, 34)
	 * $query->filterByEtMdate(array('min' => 12)); // WHERE et_mdate > 12
	 * </code>
	 *
	 * @param     mixed $etMdate The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    EmailTemplateQuery The current query, for fluid interface
	 */
	public function filterByEtMdate($etMdate = null, $comparison = null)
	{
		if (is_array($etMdate)) {
			$useMinMax = false;
			if (isset($etMdate['min'])) {
				$this->addUsingAlias(EmailTemplatePeer::ET_MDATE, $etMdate['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($etMdate['max'])) {
				$this->addUsingAlias(EmailTemplatePeer::ET_MDATE, $etMdate['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(EmailTemplatePeer::ET_MDATE, $etMdate, $comparison);
	}

	/**
	 * Filter the query on the et_user_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByEtUserId(1234); // WHERE et_user_id = 1234
	 * $query->filterByEtUserId(array(12, 34)); // WHERE et_user_id IN (12, 34)
	 * $query->filterByEtUserId(array('min' => 12)); // WHERE et_user_id > 12
	 * </code>
	 *
	 * @param     mixed $etUserId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    EmailTemplateQuery The current query, for fluid interface
	 */
	public function filterByEtUserId($etUserId = null, $comparison = null)
	{
		if (is_array($etUserId)) {
			$useMinMax = false;
			if (isset($etUserId['min'])) {
				$this->addUsingAlias(EmailTemplatePeer::ET_USER_ID, $etUserId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($etUserId['max'])) {
				$this->addUsingAlias(EmailTemplatePeer::ET_USER_ID, $etUserId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(EmailTemplatePeer::ET_USER_ID, $etUserId, $comparison);
	}

	/**
	 * Exclude object from result
	 *
	 * @param     EmailTemplate $emailTemplate Object to remove from the list of results
	 *
	 * @return    EmailTemplateQuery The current query, for fluid interface
	 */
	public function prune($emailTemplate = null)
	{
		if ($emailTemplate) {
			$this->addUsingAlias(EmailTemplatePeer::ET_ID, $emailTemplate->getEtId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseEmailTemplateQuery